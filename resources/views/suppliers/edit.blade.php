@extends('layouts.app')

@section('title', 'Edit Supplier - Inventory Management System')

@section('breadcrumb', 'Edit Supplier')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-pencil-square me-2 text-info"></i>Edit Supplier</h1>
    <a href="{{ route('suppliers.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Back to Suppliers
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card animate-fade-in">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-truck me-2"></i>Supplier Information</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('suppliers.update', $supplier) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Supplier Name <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-building"></i></span>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name', $supplier->name) }}" required>
                            </div>
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email', $supplier->email) }}" required>
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="form-label">Phone Number</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-telephone"></i></span>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" name="phone" value="{{ old('phone', $supplier->phone) }}">
                        </div>
                        @error('phone')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="address" class="form-label">Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-geo-alt"></i></span>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      id="address" name="address" rows="3">{{ old('address', $supplier->address) }}</textarea>
                        </div>
                        @error('address')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="my-4">

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-1"></i>Update Supplier
                        </button>
                        <a href="{{ route('suppliers.index') }}" class="btn btn-outline-secondary">
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
                <h6 class="mb-0"><i class="bi bi-info-circle me-2 text-info"></i>Supplier Status</h6>
            </div>
            <div class="card-body">
                <div class="mb-3 pb-3 border-bottom">
                    <div class="text-muted small mb-1"><i class="bi bi-box me-1"></i>Products Supplied</div>
                    <span class="badge bg-primary fs-6 rounded-pill">
                        {{ $supplier->products->count() }} products
                    </span>
                </div>
                <div class="mb-3">
                    <div class="text-muted small mb-1"><i class="bi bi-calendar-plus me-1"></i>Created</div>
                    <div class="fw-medium">{{ $supplier->created_at->format('M d, Y \a\t h:i A') }}</div>
                </div>
                <div>
                    <div class="text-muted small mb-1"><i class="bi bi-calendar-check me-1"></i>Last Updated</div>
                    <div class="fw-medium">{{ $supplier->updated_at->format('M d, Y \a\t h:i A') }}</div>
                </div>
            </div>
        </div>

        <div class="card mt-4 animate-fade-in animate-delay-2">
            <div class="card-header">
                <h6 class="mb-0"><i class="bi bi-lightning-charge me-2 text-warning"></i>Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('suppliers.show', $supplier) }}" class="btn btn-outline-info">
                        <i class="bi bi-eye me-2"></i>View Supplier Details
                    </a>
                    <a href="{{ route('suppliers.create') }}" class="btn btn-outline-success">
                        <i class="bi bi-plus-circle me-2"></i>Add New Supplier
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection