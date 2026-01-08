<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'sku', 'price', 'unit_cost',
        'holding_cost_percent', 'quantity_in_stock', 'minimum_stock_level',
        'reorder_quantity', 'safety_stock', 'priority',
        'category_id', 'supplier_id'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'unit_cost' => 'decimal:2',
        'holding_cost_percent' => 'decimal:2',
        'quantity_in_stock' => 'integer',
        'minimum_stock_level' => 'integer',
        'reorder_quantity' => 'integer',
        'safety_stock' => 'integer'
    ];

    // relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function inventoryTransactions()
    {
        return $this->hasMany(InventoryTransaction::class);
    }

    // stock checks
    public function isLowStock()
    {
        return $this->quantity_in_stock <= $this->minimum_stock_level;
    }

    public function isOutOfStock()
    {
        return $this->quantity_in_stock == 0;
    }

    public function getStockStatus(): string
    {
        if ($this->quantity_in_stock == 0) return 'out_of_stock';
        if ($this->isLowStock()) return 'low_stock';
        return 'in_stock';
    }

    // for badge display in views
    public function getPriorityBadgeClass(): string
    {
        return match($this->priority ?? 'medium') {
            'critical' => 'bg-danger',
            'high' => 'bg-warning',
            'medium' => 'bg-info',
            'low' => 'bg-secondary',
            default => 'bg-info',
        };
    }

    // accessors
    public function getFormattedPriceAttribute()
    {
        // TODO: make currency configurable
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getProfitMarginAttribute()
    {
        if ($this->unit_cost > 0) {
            return round((($this->price - $this->unit_cost) / $this->price) * 100, 1);
        }
        return 0;
    }
}