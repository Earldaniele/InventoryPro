@extends('layouts.app')

@section('title', 'Add Supplier - Inventory Management System')

@section('breadcrumb', 'Add Supplier')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-person-plus me-2 text-info"></i>Add New Supplier</h1>
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
                <form action="{{ route('suppliers.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Supplier Name <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-building"></i></span>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" placeholder="Enter supplier name" required>
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
                                       id="email" name="email" value="{{ old('email') }}" placeholder="supplier@example.com" required>
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
                                   id="phone" name="phone" value="{{ old('phone') }}" placeholder="+1 (555) 000-0000">
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
                                      id="address" name="address" rows="3" placeholder="Enter full business address">{{ old('address') }}</textarea>
                        </div>
                        @error('address')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <div class="form-text"><i class="bi bi-info-circle me-1"></i>Optional: Complete business address of the supplier.</div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-1"></i>Save Supplier
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
                <h6 class="mb-0"><i class="bi bi-info-circle me-2 text-info"></i>Supplier Tips</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-3 d-flex align-items-start">
                        <i class="bi bi-check-circle text-success me-3 mt-1"></i>
                        <span>Name and email are required fields</span>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <i class="bi bi-check-circle text-success me-3 mt-1"></i>
                        <span>Email must be unique for each supplier</span>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <i class="bi bi-check-circle text-success me-3 mt-1"></i>
                        <span>Phone and address are optional</span>
                    </li>
                    <li class="d-flex align-items-start">
                        <i class="bi bi-pencil text-primary me-3 mt-1"></i>
                        <span>You can edit supplier details anytime</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection