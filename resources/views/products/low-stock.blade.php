@extends('layouts.app')

@section('title', 'Low Stock Alert - Inventory Management System')

@section('breadcrumb', 'Low Stock Alert')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-exclamation-octagon me-2 text-warning"></i>Low Stock Alert</h1>
    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Back to Products
    </a>
</div>

@if($products->count() > 0)
<div class="alert alert-warning animate-fade-in">
    <div class="d-flex align-items-center">
        <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
        <div>
            <strong>Attention Required!</strong>
            <p class="mb-0">{{ $products->count() }} product(s) are running low on stock or out of stock. Consider restocking soon.</p>
        </div>
    </div>
</div>

<div class="card animate-fade-in">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-list-ul me-2"></i>Low Stock Products</span>
        <span class="badge bg-warning">{{ $products->count() }} items need attention</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>SKU</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Supplier</th>
                        <th>Current Stock</th>
                        <th>Min. Level</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr class="{{ $product->quantity_in_stock == 0 ? 'out-of-stock' : 'low-stock' }}">
                        <td><code class="text-muted">{{ $product->sku }}</code></td>
                        <td class="fw-medium">{{ $product->name }}</td>
                        <td>
                            <span class="badge bg-light text-dark border">
                                <i class="bi bi-bookmark me-1"></i>{{ $product->category->name }}
                            </span>
                        </td>
                        <td>
                            <span class="text-muted">
                                <i class="bi bi-building me-1"></i>{{ $product->supplier->name }}
                            </span>
                        </td>
                        <td>
                            <span class="fw-bold fs-5 {{ $product->quantity_in_stock == 0 ? 'text-danger' : 'text-warning' }}">
                                {{ $product->quantity_in_stock }}
                            </span>
                        </td>
                        <td class="text-muted">{{ $product->minimum_stock_level }}</td>
                        <td>
                            @if($product->quantity_in_stock == 0)
                                <span class="badge bg-danger">
                                    <i class="bi bi-x-circle me-1"></i>Out of Stock
                                </span>
                            @else
                                <span class="badge bg-warning">
                                    <i class="bi bi-exclamation-circle me-1"></i>Low Stock
                                </span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-primary" title="Restock">
                                    <i class="bi bi-plus-circle me-1"></i>Restock
                                </a>
                                <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-info" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@else
<div class="card animate-fade-in">
    <div class="card-body">
        <div class="empty-state">
            <i class="bi bi-check-circle text-success"></i>
            <h3 class="text-success">All Products Are Well Stocked!</h3>
            <p>Congratulations! No products are currently running low on stock.</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary">
                <i class="bi bi-box me-1"></i>View All Products
            </a>
        </div>
    </div>
</div>
@endif
@endsection