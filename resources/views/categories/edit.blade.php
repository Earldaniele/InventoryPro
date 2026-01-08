@extends('layouts.app')

@section('title', 'Edit Category - Inventory Management System')

@section('breadcrumb', 'Edit Category')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-pencil-square me-2 text-success"></i>Edit Category</h1>
    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Back to Categories
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="card animate-fade-in">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-bookmark-star me-2"></i>Category Information</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('categories.update', $category) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-bookmark"></i></span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $category->name) }}" required>
                        </div>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="4">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="my-4">

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-1"></i>Update Category
                        </button>
                        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x me-1"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card animate-fade-in animate-delay-1">
            <div class="card-header">
                <h6 class="mb-0"><i class="bi bi-info-circle me-2 text-info"></i>Category Status</h6>
            </div>
            <div class="card-body">
                <div class="mb-3 pb-3 border-bottom">
                    <div class="text-muted small mb-1"><i class="bi bi-box me-1"></i>Products in Category</div>
                    <span class="badge bg-primary fs-6 rounded-pill">
                        {{ $category->products->count() }} products
                    </span>
                </div>
                <div class="mb-3">
                    <div class="text-muted small mb-1"><i class="bi bi-calendar-plus me-1"></i>Created</div>
                    <div class="fw-medium">{{ $category->created_at->format('M d, Y \a\t h:i A') }}</div>
                </div>
                <div>
                    <div class="text-muted small mb-1"><i class="bi bi-calendar-check me-1"></i>Last Updated</div>
                    <div class="fw-medium">{{ $category->updated_at->format('M d, Y \a\t h:i A') }}</div>
                </div>
            </div>
        </div>

        <div class="card mt-4 animate-fade-in animate-delay-2">
            <div class="card-header">
                <h6 class="mb-0"><i class="bi bi-lightning-charge me-2 text-warning"></i>Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('categories.show', $category) }}" class="btn btn-outline-info">
                        <i class="bi bi-eye me-2"></i>View Category Details
                    </a>
                    <a href="{{ route('categories.create') }}" class="btn btn-outline-success">
                        <i class="bi bi-plus-circle me-2"></i>Add New Category
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection