@extends('layouts.app')

@section('title', 'Edit Product - Inventory Management System')

@section('breadcrumb', 'Edit Product')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-pencil-square me-2 text-primary"></i>Edit Product</h1>
    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Back to Products
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card animate-fade-in">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-box-seam me-2"></i>Product Information</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('products.update', $product) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-box"></i></span>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name', $product->name) }}" required>
                            </div>
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="sku" class="form-label">SKU <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-upc"></i></span>
                                <input type="text" class="form-control @error('sku') is-invalid @enderror" 
                                       id="sku" name="sku" value="{{ old('sku', $product->sku) }}" required>
                            </div>
                            @error('sku')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-bookmark"></i></span>
                                <select class="form-select @error('category_id') is-invalid @enderror" 
                                        id="category_id" name="category_id" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" 
                                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="supplier_id" class="form-label">Supplier <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-truck"></i></span>
                                <select class="form-select @error('supplier_id') is-invalid @enderror" 
                                        id="supplier_id" name="supplier_id" required>
                                    <option value="">Select Supplier</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" 
                                                {{ old('supplier_id', $product->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('supplier_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-currency-dollar"></i></span>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                       id="price" name="price" value="{{ old('price', $product->price) }}" 
                                       step="0.01" min="0" required>
                            </div>
                            @error('price')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="unit_cost" class="form-label">Unit Cost</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-tag"></i></span>
                                <input type="number" class="form-control @error('unit_cost') is-invalid @enderror" 
                                       id="unit_cost" name="unit_cost" 
                                       value="{{ old('unit_cost', $product->unit_cost) }}" 
                                       step="0.01" min="0" placeholder="Auto-calculated if empty">
                            </div>
                            @error('unit_cost')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Used for EOQ & profit calculations</small>
                        </div>
                        <div class="col-md-4">
                            <label for="priority" class="form-label">Priority Level</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-star"></i></span>
                                <select class="form-select @error('priority') is-invalid @enderror" 
                                        id="priority" name="priority">
                                    <option value="low" {{ old('priority', $product->priority) == 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ old('priority', $product->priority ?? 'medium') == 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ old('priority', $product->priority) == 'high' ? 'selected' : '' }}>High</option>
                                    <option value="critical" {{ old('priority', $product->priority) == 'critical' ? 'selected' : '' }}>Critical</option>
                                </select>
                            </div>
                            @error('priority')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label for="quantity_in_stock" class="form-label">Current Stock <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-stack"></i></span>
                                <input type="number" class="form-control @error('quantity_in_stock') is-invalid @enderror" 
                                       id="quantity_in_stock" name="quantity_in_stock" 
                                       value="{{ old('quantity_in_stock', $product->quantity_in_stock) }}" 
                                       min="0" required>
                            </div>
                            @error('quantity_in_stock')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="minimum_stock_level" class="form-label">Minimum Stock <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-exclamation-triangle"></i></span>
                                <input type="number" class="form-control @error('minimum_stock_level') is-invalid @enderror" 
                                       id="minimum_stock_level" name="minimum_stock_level" 
                                       value="{{ old('minimum_stock_level', $product->minimum_stock_level) }}" 
                                       min="0" required>
                            </div>
                            @error('minimum_stock_level')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="safety_stock" class="form-label">Safety Stock</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-shield-check"></i></span>
                                <input type="number" class="form-control @error('safety_stock') is-invalid @enderror" 
                                       id="safety_stock" name="safety_stock" 
                                       value="{{ old('safety_stock', $product->safety_stock ?? 0) }}" 
                                       min="0">
                            </div>
                            @error('safety_stock')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Buffer stock for demand variability</small>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-1"></i>Update Product
                        </button>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x me-1"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card animate-fade-in animate-delay-1">
            <div class="card-header">
                <h6 class="mb-0"><i class="bi bi-info-circle me-2 text-info"></i>Product Status</h6>
            </div>
            <div class="card-body">
                <div class="mb-3 pb-3 border-bottom">
                    <div class="text-muted small mb-1">Current Status</div>
                    @if($product->quantity_in_stock == 0)
                        <span class="badge bg-danger fs-6">
                            <i class="bi bi-x-circle me-1"></i>Out of Stock
                        </span>
                    @elseif($product->isLowStock())
                        <span class="badge bg-warning fs-6">
                            <i class="bi bi-exclamation-circle me-1"></i>Low Stock
                        </span>
                    @else
                        <span class="badge bg-success fs-6">
                            <i class="bi bi-check-circle me-1"></i>In Stock
                        </span>
                    @endif
                </div>
                <div class="mb-3">
                    <div class="text-muted small mb-1"><i class="bi bi-calendar-plus me-1"></i>Created</div>
                    <div class="fw-medium">{{ $product->created_at->format('M d, Y \a\t h:i A') }}</div>
                </div>
                <div>
                    <div class="text-muted small mb-1"><i class="bi bi-calendar-check me-1"></i>Last Updated</div>
                    <div class="fw-medium">{{ $product->updated_at->format('M d, Y \a\t h:i A') }}</div>
                </div>
            </div>
        </div>

        <div class="card mt-4 animate-fade-in animate-delay-2">
            <div class="card-header">
                <h6 class="mb-0"><i class="bi bi-lightning-charge me-2 text-warning"></i>Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('products.show', $product) }}" class="btn btn-outline-info">
                        <i class="bi bi-eye me-2"></i>View Product Details
                    </a>
                    <a href="{{ route('products.create') }}" class="btn btn-outline-primary">
                        <i class="bi bi-plus-circle me-2"></i>Add New Product
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection