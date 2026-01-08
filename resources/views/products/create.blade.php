@extends('layouts.app')

@section('title', 'Add Product - Inventory Management System')

@section('breadcrumb', 'Add Product')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-plus-circle me-2 text-primary"></i>Add New Product</h1>
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
                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-box"></i></span>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" placeholder="Enter product name" required>
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
                                       id="sku" name="sku" value="{{ old('sku') }}" placeholder="e.g., PROD-001" required>
                            </div>
                            @error('sku')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3" placeholder="Enter product description (optional)">{{ old('description') }}</textarea>
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
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                        <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
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
                                       id="price" name="price" value="{{ old('price') }}" 
                                       step="0.01" min="0" placeholder="0.00" required>
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
                                       id="unit_cost" name="unit_cost" value="{{ old('unit_cost') }}" 
                                       step="0.01" min="0" placeholder="Auto-calculated">
                            </div>
                            @error('unit_cost')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">For EOQ calculations</small>
                        </div>
                        <div class="col-md-4">
                            <label for="priority" class="form-label">Priority Level</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-star"></i></span>
                                <select class="form-select @error('priority') is-invalid @enderror" 
                                        id="priority" name="priority">
                                    <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ old('priority', 'medium') == 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                                    <option value="critical" {{ old('priority') == 'critical' ? 'selected' : '' }}>Critical</option>
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
                                       id="quantity_in_stock" name="quantity_in_stock" value="{{ old('quantity_in_stock') }}" 
                                       min="0" placeholder="0" required>
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
                                       id="minimum_stock_level" name="minimum_stock_level" value="{{ old('minimum_stock_level') }}" 
                                       min="0" placeholder="0" required>
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
                                       id="safety_stock" name="safety_stock" value="{{ old('safety_stock', 0) }}" 
                                       min="0" placeholder="0">
                            </div>
                            @error('safety_stock')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Buffer for demand variability</small>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-1"></i>Save Product
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
                <h6 class="mb-0"><i class="bi bi-lightning-charge me-2 text-warning"></i>Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('categories.create') }}" class="btn btn-outline-primary">
                        <i class="bi bi-bookmark-plus me-2"></i>Add New Category
                    </a>
                    <a href="{{ route('suppliers.create') }}" class="btn btn-outline-success">
                        <i class="bi bi-person-plus me-2"></i>Add New Supplier
                    </a>
                </div>
            </div>
        </div>

        <div class="card mt-4 animate-fade-in animate-delay-2">
            <div class="card-header">
                <h6 class="mb-0"><i class="bi bi-info-circle me-2 text-info"></i>Tips</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0 small text-muted">
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success me-2"></i>
                        Use unique SKU codes for easy tracking
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success me-2"></i>
                        Set minimum stock to get low stock alerts
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success me-2"></i>
                        Add detailed descriptions for clarity
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection