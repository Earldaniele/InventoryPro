@extends('layouts.app')

@section('title', 'Add Category - Inventory Management System')

@section('breadcrumb', 'Add Category')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-bookmark-plus me-2 text-success"></i>Add New Category</h1>
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
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-bookmark"></i></span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" placeholder="Enter category name" required>
                        </div>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="4" placeholder="Enter category description (optional)">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text"><i class="bi bi-info-circle me-1"></i>Optional: Provide a brief description of this category.</div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-1"></i>Save Category
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
                <h6 class="mb-0"><i class="bi bi-lightbulb me-2 text-warning"></i>Category Guidelines</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-3 d-flex align-items-start">
                        <i class="bi bi-check-circle text-success me-3 mt-1"></i>
                        <span>Choose clear, descriptive names for your categories</span>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <i class="bi bi-check-circle text-success me-3 mt-1"></i>
                        <span>Categories help organize and filter your products</span>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <i class="bi bi-check-circle text-success me-3 mt-1"></i>
                        <span>You can always edit category details later</span>
                    </li>
                    <li class="d-flex align-items-start">
                        <i class="bi bi-exclamation-circle text-warning me-3 mt-1"></i>
                        <span>Categories with products cannot be deleted</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection