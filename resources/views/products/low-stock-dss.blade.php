@extends('layouts.app')

@section('title', 'Inventory Decision Support System - Low Stock Analysis')

@section('breadcrumb', 'Stock Analysis DSS')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-graph-up-arrow me-2 text-primary"></i>Inventory Decision Support System</h1>
    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Back to Products
    </a>
</div>

<!-- DSS Summary Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-6 col-lg-3">
        <div class="stat-card warning animate-fade-in animate-delay-1">
            <i class="bi bi-exclamation-octagon stat-icon"></i>
            <div class="stat-value">{{ $summary['total_products'] }}</div>
            <div class="stat-label">Products Need Attention</div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card primary animate-fade-in animate-delay-2" style="background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);">
            <i class="bi bi-lightning-charge stat-icon"></i>
            <div class="stat-value">{{ $summary['critical_count'] + $summary['high_count'] }}</div>
            <div class="stat-label">Urgent Actions Required</div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card info animate-fade-in animate-delay-3">
            <i class="bi bi-currency-dollar stat-icon"></i>
            <div class="stat-value">${{ number_format($summary['daily_revenue_at_risk'], 0) }}</div>
            <div class="stat-label">Daily Revenue at Risk</div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card success animate-fade-in animate-delay-4">
            <i class="bi bi-cart-check stat-icon"></i>
            <div class="stat-value">${{ number_format($summary['total_reorder_value'], 0) }}</div>
            <div class="stat-label">Est. Reorder Investment</div>
        </div>
    </div>
</div>

<!-- Urgency Breakdown -->
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card animate-fade-in">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-speedometer2 me-2 text-primary"></i>Priority Analysis Dashboard</h5>
                <div class="d-flex gap-2">
                    <span class="badge bg-danger">{{ $summary['critical_count'] }} Critical</span>
                    <span class="badge bg-warning">{{ $summary['high_count'] }} High</span>
                    <span class="badge bg-info">{{ $summary['medium_count'] }} Medium</span>
                    <span class="badge bg-secondary">{{ $summary['low_count'] }} Low</span>
                </div>
            </div>
            <div class="card-body">
                @if($summary['total_products'] > 0)
                <div class="progress mb-3" style="height: 30px; border-radius: 15px;">
                    @if($summary['critical_count'] > 0)
                    <div class="progress-bar bg-danger" role="progressbar" 
                         style="width: {{ ($summary['critical_count'] / $summary['total_products']) * 100 }}%">
                        {{ $summary['critical_count'] }} Critical
                    </div>
                    @endif
                    @if($summary['high_count'] > 0)
                    <div class="progress-bar bg-warning" role="progressbar" 
                         style="width: {{ ($summary['high_count'] / $summary['total_products']) * 100 }}%">
                        {{ $summary['high_count'] }} High
                    </div>
                    @endif
                    @if($summary['medium_count'] > 0)
                    <div class="progress-bar bg-info" role="progressbar" 
                         style="width: {{ ($summary['medium_count'] / $summary['total_products']) * 100 }}%">
                        {{ $summary['medium_count'] }} Medium
                    </div>
                    @endif
                    @if($summary['low_count'] > 0)
                    <div class="progress-bar bg-secondary" role="progressbar" 
                         style="width: {{ ($summary['low_count'] / $summary['total_products']) * 100 }}%">
                        {{ $summary['low_count'] }} Low
                    </div>
                    @endif
                </div>

                <div class="row text-center">
                    <div class="col-md-3">
                        <div class="border rounded p-3 h-100 bg-danger bg-opacity-10">
                            <i class="bi bi-exclamation-triangle-fill text-danger fs-3"></i>
                            <h4 class="text-danger mb-1">{{ $summary['critical_count'] }}</h4>
                            <small class="text-muted">Will stockout before delivery</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="border rounded p-3 h-100 bg-warning bg-opacity-10">
                            <i class="bi bi-clock-fill text-warning fs-3"></i>
                            <h4 class="text-warning mb-1">{{ $summary['high_count'] }}</h4>
                            <small class="text-muted">Order within 1-2 weeks</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="border rounded p-3 h-100 bg-info bg-opacity-10">
                            <i class="bi bi-calendar-week text-info fs-3"></i>
                            <h4 class="text-info mb-1">{{ $summary['medium_count'] }}</h4>
                            <small class="text-muted">Monitor closely</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="border rounded p-3 h-100 bg-secondary bg-opacity-10">
                            <i class="bi bi-eye text-secondary fs-3"></i>
                            <h4 class="text-secondary mb-1">{{ $summary['low_count'] }}</h4>
                            <small class="text-muted">Watch list</small>
                        </div>
                    </div>
                </div>
                @else
                <div class="text-center py-4">
                    <i class="bi bi-check-circle text-success fs-1"></i>
                    <h5 class="text-success mt-2">All inventory levels are healthy!</h5>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card animate-fade-in h-100">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-cash-stack me-2 text-success"></i>Financial Impact</h5>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted">Daily Revenue at Risk</span>
                        <span class="fw-bold text-danger">${{ number_format($summary['daily_revenue_at_risk'], 2) }}</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-danger" style="width: 100%"></div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted">Potential Stockout Cost</span>
                        <span class="fw-bold text-warning">${{ number_format($summary['total_stockout_cost'], 2) }}</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-warning" style="width: 75%"></div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted">Required Investment</span>
                        <span class="fw-bold text-success">${{ number_format($summary['total_reorder_value'], 2) }}</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-success" style="width: 60%"></div>
                    </div>
                </div>

                <hr>

                <div class="alert alert-info mb-0">
                    <i class="bi bi-lightbulb me-2"></i>
                    <strong>DSS Insight:</strong> Taking action now can prevent an estimated 
                    <strong>${{ number_format($summary['total_stockout_cost'], 2) }}</strong> in lost revenue.
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Supplier Order Recommendations -->
@if($summary['supplier_orders']->count() > 0)
<div class="card mb-4 animate-fade-in">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-truck me-2 text-info"></i>Recommended Supplier Orders</h5>
    </div>
    <div class="card-body">
        <div class="row g-3">
            @foreach($summary['supplier_orders'] as $order)
            <div class="col-md-6 col-lg-4">
                <div class="border rounded p-3 h-100">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h6 class="mb-1">{{ $order['supplier']->name }}</h6>
                            <small class="text-muted">
                                <i class="bi bi-clock me-1"></i>{{ $order['supplier']->lead_time_days ?? 7 }} days lead time
                            </small>
                        </div>
                        <span class="badge {{ $order['supplier']->getReliabilityBadgeClass() }}">
                            {{ $order['supplier']->reliability_percent ?? 90 }}% reliable
                        </span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            <span class="badge bg-primary rounded-pill">{{ $order['product_count'] }} products</span>
                        </div>
                        <div class="text-end">
                            <div class="small text-muted">Estimated Order</div>
                            <strong class="text-success">${{ number_format($order['total_order_value'], 2) }}</strong>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- Detailed Product Analysis Table -->
<div class="card animate-fade-in">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-table me-2"></i>Detailed Stock Analysis & Recommendations</h5>
        <span class="badge bg-primary">{{ $dssData->count() }} items analyzed</span>
    </div>
    <div class="card-body p-0">
        @if($dssData->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th style="width: 50px;">Priority</th>
                        <th>Product</th>
                        <th class="text-center">Current Stock</th>
                        <th class="text-center">Days to Stockout</th>
                        <th class="text-center">Consumption Trend</th>
                        <th class="text-center">Lead Time</th>
                        <th class="text-center">Recommended Order</th>
                        <th class="text-center">Est. Cost</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dssData as $item)
                    <tr class="@if($item['urgency'] === 'critical') table-danger @elseif($item['urgency'] === 'high') table-warning @endif">
                        <td>
                            <div class="d-flex flex-column align-items-center">
                                <div class="badge rounded-pill mb-1
                                    @if($item['urgency'] === 'critical') bg-danger
                                    @elseif($item['urgency'] === 'high') bg-warning
                                    @elseif($item['urgency'] === 'medium') bg-info
                                    @else bg-secondary @endif"
                                    style="width: 40px;">
                                    {{ $item['priority_score'] }}
                                </div>
                                <small class="text-muted text-uppercase" style="font-size: 0.65rem;">{{ $item['urgency'] }}</small>
                            </div>
                        </td>
                        <td>
                            <div class="fw-medium">{{ $item['product']->name }}</div>
                            <small class="text-muted">
                                <code>{{ $item['product']->sku }}</code> · 
                                {{ $item['product']->category->name }} · 
                                {{ $item['product']->supplier->name }}
                            </small>
                        </td>
                        <td class="text-center">
                            <div class="fw-bold {{ $item['product']->quantity_in_stock == 0 ? 'text-danger' : 'text-warning' }} fs-5">
                                {{ $item['product']->quantity_in_stock }}
                            </div>
                            <small class="text-muted">/ {{ $item['product']->minimum_stock_level }} min</small>
                        </td>
                        <td class="text-center">
                            @if($item['days_until_stockout'] !== null)
                                @if($item['days_until_stockout'] <= 0)
                                    <span class="badge bg-danger fs-6">OUT NOW</span>
                                @elseif($item['days_until_stockout'] <= 7)
                                    <span class="badge bg-danger">{{ $item['days_until_stockout'] }} days</span>
                                @elseif($item['days_until_stockout'] <= 14)
                                    <span class="badge bg-warning">{{ $item['days_until_stockout'] }} days</span>
                                @else
                                    <span class="badge bg-info">{{ $item['days_until_stockout'] }} days</span>
                                @endif
                            @else
                                <span class="text-muted">-</span>
                            @endif
                            <div class="small text-muted mt-1">
                                {{ $item['avg_daily_consumption'] }} units/day
                            </div>
                        </td>
                        <td class="text-center">
                            @if($item['consumption_trend'] === 'increasing')
                                <span class="badge bg-danger">
                                    <i class="bi bi-arrow-up-right"></i> Increasing
                                </span>
                            @elseif($item['consumption_trend'] === 'decreasing')
                                <span class="badge bg-success">
                                    <i class="bi bi-arrow-down-right"></i> Decreasing
                                </span>
                            @else
                                <span class="badge bg-secondary">
                                    <i class="bi bi-arrow-right"></i> Stable
                                </span>
                            @endif
                        </td>
                        <td class="text-center">
                            <span class="fw-medium">{{ $item['lead_time_days'] }} days</span>
                            <div class="small">
                                <span class="badge {{ $item['product']->supplier->getReliabilityBadgeClass() }} bg-opacity-75" style="font-size: 0.65rem;">
                                    {{ round($item['supplier_reliability'] * 100) }}% reliable
                                </span>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="fw-bold text-primary fs-5">{{ $item['recommended_qty'] }}</div>
                            <small class="text-muted">units</small>
                            <div class="small text-muted">(EOQ: {{ $item['eoq'] }})</div>
                        </td>
                        <td class="text-center">
                            <div class="fw-bold text-success">${{ number_format($item['recommended_qty'] * $item['unit_cost'], 2) }}</div>
                            <small class="text-muted">@ ${{ number_format($item['unit_cost'], 2) }}/unit</small>
                        </td>
                        <td class="text-center">
                            <div class="btn-group-vertical btn-group-sm">
                                <a href="{{ route('products.edit', $item['product']) }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus-circle me-1"></i>Restock
                                </a>
                                <a href="{{ route('products.show', $item['product']) }}" class="btn btn-outline-info btn-sm">
                                    <i class="bi bi-graph-up me-1"></i>Analysis
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
            <h3 class="text-success mt-3">Excellent! All Products Are Well Stocked</h3>
            <p class="text-muted">No products currently require reordering. The DSS will alert you when action is needed.</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary">
                <i class="bi bi-box me-1"></i>View All Products
            </a>
        </div>
        @endif
    </div>
</div>

<!-- DSS Legend & Help -->
<div class="card mt-4 animate-fade-in">
    <div class="card-header">
        <h6 class="mb-0"><i class="bi bi-question-circle me-2"></i>Understanding the DSS Metrics</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <h6 class="text-primary"><i class="bi bi-speedometer2 me-1"></i> Priority Score (0-100)</h6>
                <p class="small text-muted">
                    Calculated based on: stock urgency, consumption velocity, trend direction, and product priority setting. 
                    Higher score = higher priority for action.
                </p>
            </div>
            <div class="col-md-4">
                <h6 class="text-info"><i class="bi bi-calculator me-1"></i> EOQ (Economic Order Quantity)</h6>
                <p class="small text-muted">
                    The optimal order quantity that minimizes total inventory costs (ordering + holding costs). 
                    Based on Wilson's EOQ formula.
                </p>
            </div>
            <div class="col-md-4">
                <h6 class="text-success"><i class="bi bi-graph-up me-1"></i> Recommended Qty</h6>
                <p class="small text-muted">
                    Smart recommendation bounded by EOQ, minimum stock levels, and max 3-month supply to avoid overstocking.
                </p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <h6><i class="bi bi-palette me-1"></i> Urgency Levels</h6>
                <ul class="list-unstyled small">
                    <li><span class="badge bg-danger me-2">Critical</span> Will stockout before order arrives - ORDER NOW</li>
                    <li><span class="badge bg-warning me-2">High</span> Will stockout within 2× lead time - Order this week</li>
                    <li><span class="badge bg-info me-2">Medium</span> Will stockout within 30 days - Plan to order</li>
                    <li><span class="badge bg-secondary me-2">Low</span> Stock below threshold but stable - Monitor</li>
                </ul>
            </div>
            <div class="col-md-6">
                <h6><i class="bi bi-arrow-left-right me-1"></i> Consumption Trends</h6>
                <ul class="list-unstyled small">
                    <li><span class="badge bg-danger me-2"><i class="bi bi-arrow-up-right"></i> Increasing</span> Demand growing >15% vs prior period</li>
                    <li><span class="badge bg-secondary me-2"><i class="bi bi-arrow-right"></i> Stable</span> Demand within ±15% of prior period</li>
                    <li><span class="badge bg-success me-2"><i class="bi bi-arrow-down-right"></i> Decreasing</span> Demand falling >15% vs prior period</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
