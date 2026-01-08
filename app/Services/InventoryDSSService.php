<?php

namespace App\Services;

use App\Models\Product;
use App\Models\InventoryTransaction;
use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
 * DSS (Decision Support System) for inventory reordering
 * 
 * Uses EOQ formula and consumption trends to suggest when/how much to reorder.
 * The priority scoring is somewhat arbitrary - might need tuning.
 */
class InventoryDSSService
{
    // TODO: make this configurable per-product or globally
    const ORDERING_COST = 50;
    
    /**
     * Main method - calculates all the DSS metrics for a product
     */
    public function calculateProductMetrics(Product $product): array
    {
        $consumption = $this->getConsumptionData($product);
        $avgDaily = $consumption['avg_daily'];
        
        // days until we run out (null if no consumption)
        $daysLeft = $avgDaily > 0 
            ? round($product->quantity_in_stock / $avgDaily, 1)
            : null;
        
        $leadTime = $product->supplier->lead_time_days ?? 7; // default 7 days
        
        // safety stock - either what's set, or estimate based on consumption
        $safetyStock = $product->safety_stock ?? max(ceil($avgDaily * 2), $product->minimum_stock_level);
        $reorderPoint = ceil(($avgDaily * $leadTime) + $safetyStock);
        
        // EOQ calculation
        // formula: sqrt((2 * annual_demand * ordering_cost) / holding_cost)
        $annualDemand = $avgDaily * 365;
        $holdingPct = $product->holding_cost_percent ?? 20;
        $unitCost = $product->unit_cost > 0 ? $product->unit_cost : ($product->price * 0.6); // assume 60% cost if not set
        $holdingCost = $unitCost * ($holdingPct / 100);
        
        $eoq = ($holdingCost > 0 && $annualDemand > 0)
            ? round(sqrt((2 * $annualDemand * self::ORDERING_COST) / $holdingCost))
            : ($product->reorder_quantity ?? 100);
        
        // bound the recommendation to something sensible
        $recommendedQty = max($eoq, $product->minimum_stock_level * 2);
        $recommendedQty = min($recommendedQty, $annualDemand > 0 ? ceil($annualDemand / 4) : 500);
        
        $priorityScore = $this->calcPriority($product, $daysLeft, $avgDaily, $consumption['trend']);
        $urgency = $this->getUrgency($daysLeft, $leadTime, $product);
        
        // money stuff
        $dailyRevenue = $avgDaily * $product->price;
        $stockoutCost = ($daysLeft !== null && $daysLeft < $leadTime)
            ? ($leadTime - $daysLeft) * $dailyRevenue
            : 0;
        
        $margin = $unitCost > 0 ? (($product->price - $unitCost) / $product->price) * 100 : 0;
        
        return [
            'product' => $product,
            'avg_daily_consumption' => round($avgDaily, 2),
            'total_consumption_30_days' => $consumption['total_30_days'],
            'consumption_trend' => $consumption['trend'],
            'days_until_stockout' => $daysLeft,
            'lead_time_days' => $leadTime,
            'safety_stock' => $safetyStock,
            'reorder_point' => $reorderPoint,
            'recommended_qty' => $recommendedQty,
            'eoq' => $eoq,
            'priority_score' => $priorityScore,
            'urgency' => $urgency,
            'daily_revenue_at_risk' => round($dailyRevenue, 2),
            'potential_stockout_cost' => round($stockoutCost, 2),
            'profit_margin' => round($margin, 1),
            'unit_cost' => $unitCost,
            'supplier_reliability' => $product->supplier->reliability_score ?? 0.90,
            'needs_immediate_action' => in_array($urgency, ['critical', 'high']),
        ];
    }

    private function getConsumptionData(Product $product): array
    {
        $now = Carbon::now();
        $d30 = $now->copy()->subDays(30);
        $d60 = $now->copy()->subDays(60);
        
        // sum of 'out' transactions in last 30 days
        $last30 = InventoryTransaction::where('product_id', $product->id)
            ->where('type', 'out')
            ->where('transaction_date', '>=', $d30)
            ->sum('quantity');
        
        // previous 30 days for trend comparison
        $prev30 = InventoryTransaction::where('product_id', $product->id)
            ->where('type', 'out')
            ->where('transaction_date', '>=', $d60)
            ->where('transaction_date', '<', $d30)
            ->sum('quantity');
        
        $avg = $last30 / 30;
        
        // figure out if demand is going up or down
        $trend = 'stable';
        if ($prev30 > 0) {
            $change = (($last30 - $prev30) / $prev30) * 100;
            if ($change > 15) $trend = 'increasing';
            elseif ($change < -15) $trend = 'decreasing';
        }
        
        return [
            'avg_daily' => $avg,
            'total_30_days' => $last30,
            'prev_30_days' => $prev30,
            'trend' => $trend,
        ];
    }

    /**
     * Priority score 0-100, higher = more urgent
     * This is pretty arbitrary tbh, tweak as needed
     */
    private function calcPriority(Product $product, ?float $daysLeft, float $avgDaily, string $trend): int
    {
        $score = 0;
        
        // base score from product priority setting
        $score += match($product->priority ?? 'medium') {
            'critical' => 40,
            'high' => 30,
            'medium' => 20,
            'low' => 10,
            default => 20,
        };
        
        // how soon will we run out? (up to 30 pts)
        if ($daysLeft !== null) {
            if ($daysLeft <= 0) $score += 30;
            elseif ($daysLeft <= 3) $score += 25;
            elseif ($daysLeft <= 7) $score += 20;
            elseif ($daysLeft <= 14) $score += 15;
            elseif ($daysLeft <= 30) $score += 10;
        }
        
        // consumption velocity (up to 15 pts)
        if ($avgDaily >= 10) $score += 15;
        elseif ($avgDaily >= 5) $score += 10;
        elseif ($avgDaily >= 1) $score += 5;
        
        // trend bonus
        if ($trend === 'increasing') $score += 15;
        elseif ($trend === 'stable') $score += 5;
        
        return min(100, $score);
    }

    private function getUrgency(?float $daysLeft, int $leadTime, Product $product): string
    {
        // out of stock = always critical
        if ($product->quantity_in_stock == 0) {
            return 'critical';
        }
        
        if ($daysLeft === null) {
            return 'low'; // no consumption data
        }
        
        // will run out before order arrives
        if ($daysLeft <= $leadTime) return 'critical';
        
        // will run out within 2x lead time
        if ($daysLeft <= $leadTime * 2) return 'high';
        
        // within a month
        if ($daysLeft <= 30) return 'medium';
        
        return 'low';
    }

    /**
     * Get all low stock products with their DSS data
     */
    public function getLowStockWithDSS(): Collection
    {
        $products = Product::with(['category', 'supplier', 'inventoryTransactions'])
            ->whereColumn('quantity_in_stock', '<=', 'minimum_stock_level')
            ->get();
        
        $result = $products->map(fn($p) => $this->calculateProductMetrics($p));
        
        return $result->sortByDesc('priority_score')->values();
    }

    /**
     * Summary stats for the reorder page
     */
    public function getReorderSummary(Collection $dssData): array
    {
        $criticalCount = $dssData->where('urgency', 'critical')->count();
        $highCount = $dssData->where('urgency', 'high')->count();
        
        $revenueAtRisk = $dssData->sum('daily_revenue_at_risk');
        $stockoutCost = $dssData->sum('potential_stockout_cost');
        
        $totalOrderValue = $dssData->sum(function ($item) {
            return $item['recommended_qty'] * $item['unit_cost'];
        });
        
        // group by supplier for PO generation
        $bySupplier = $dssData->groupBy(fn($item) => $item['product']->supplier_id)
            ->map(function ($items) {
                $supplier = $items->first()['product']->supplier;
                return [
                    'supplier' => $supplier,
                    'product_count' => $items->count(),
                    'total_order_value' => $items->sum(fn($i) => $i['recommended_qty'] * $i['unit_cost']),
                    'items' => $items,
                ];
            })
            ->sortByDesc('total_order_value')
            ->values();
        
        return [
            'total_products' => $dssData->count(),
            'critical_count' => $criticalCount,
            'high_count' => $highCount,
            'medium_count' => $dssData->where('urgency', 'medium')->count(),
            'low_count' => $dssData->where('urgency', 'low')->count(),
            'daily_revenue_at_risk' => round($revenueAtRisk, 2),
            'total_stockout_cost' => round($stockoutCost, 2),
            'total_reorder_value' => round($totalOrderValue, 2),
            'supplier_orders' => $bySupplier,
        ];
    }

    /**
     * Data for the consumption chart on product detail page
     */
    public function getConsumptionChartData(Product $product, int $days = 30): array
    {
        $start = Carbon::now()->subDays($days);
        
        $txns = InventoryTransaction::where('product_id', $product->id)
            ->where('transaction_date', '>=', $start)
            ->orderBy('transaction_date')
            ->get()
            ->groupBy(fn($t) => $t->transaction_date->format('Y-m-d'));
        
        $labels = [];
        $inData = [];
        $outData = [];
        
        // build daily data
        for ($i = $days; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $key = $date->format('Y-m-d');
            $labels[] = $date->format('M d');
            
            $dayTxns = $txns->get($key, collect());
            $inData[] = $dayTxns->where('type', 'in')->sum('quantity');
            $outData[] = $dayTxns->where('type', 'out')->sum('quantity');
        }
        
        return compact('labels', 'inData', 'outData');
    }
}
