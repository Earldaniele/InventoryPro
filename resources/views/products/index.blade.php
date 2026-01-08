@extends('layouts.app')

@section('title', 'Products - Inventory Management System')

@section('breadcrumb', 'Products')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-box-seam me-2 text-primary"></i>Products</h1>
    <div class="d-flex gap-2">
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i>Add Product
        </a>
    </div>
</div>

@if($products->count() > 0)
<div class="card animate-fade-in">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-list-ul me-2"></i>All Products</span>
        <span class="badge bg-primary">{{ $products->total() }} items</span>
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
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr class="{{ $product->quantity_in_stock == 0 ? 'out-of-stock' : ($product->isLowStock() ? 'low-stock' : '') }}">
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
                        <td class="fw-bold text-success">${{ number_format($product->price, 2) }}</td>
                        <td>
                            <span class="fw-bold {{ $product->quantity_in_stock == 0 ? 'text-danger' : ($product->isLowStock() ? 'text-warning' : 'text-dark') }}">
                                {{ $product->quantity_in_stock }}
                            </span>
                        </td>
                        <td>
                            @if($product->quantity_in_stock == 0)
                                <span class="badge bg-danger">
                                    <i class="bi bi-x-circle me-1"></i>Out of Stock
                                </span>
                            @elseif($product->isLowStock())
                                <span class="badge bg-warning">
                                    <i class="bi bi-exclamation-circle me-1"></i>Low Stock
                                </span>
                            @else
                                <span class="badge bg-success">
                                    <i class="bi bi-check-circle me-1"></i>In Stock
                                </span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-info" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" style="display: inline;" 
                                      onsubmit="return confirm('Are you sure you want to delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @if($products->hasPages())
    <div class="card-footer bg-white">
        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
    @endif
</div>
@else
<div class="card animate-fade-in">
    <div class="card-body">
        <div class="empty-state">
            <i class="bi bi-box"></i>
            <h3>No Products Found</h3>
            <p>Start by adding your first product to the inventory.</p>
            <a href="{{ route('products.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i>Add First Product
            </a>
        </div>
    </div>
</div>
@endif
@endsection