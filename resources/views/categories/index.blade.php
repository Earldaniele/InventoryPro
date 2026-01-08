@extends('layouts.app')

@section('title', 'Categories - Inventory Management System')

@section('breadcrumb', 'Categories')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-bookmark-star me-2 text-success"></i>Categories</h1>
    <div class="d-flex gap-2">
        <a href="{{ route('categories.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i>Add Category
        </a>
    </div>
</div>

@if($categories->count() > 0)
<div class="card animate-fade-in">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-list-ul me-2"></i>All Categories</span>
        <span class="badge bg-success">{{ $categories->total() }} categories</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Description</th>
                        <th>Products</th>
                        <th>Created</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="bi bi-bookmark-fill text-success"></i>
                                </div>
                                <span class="fw-medium">{{ $category->name }}</span>
                            </div>
                        </td>
                        <td class="text-muted">{{ $category->description ?? 'No description' }}</td>
                        <td>
                            <span class="badge bg-primary rounded-pill">
                                <i class="bi bi-box me-1"></i>{{ $category->products_count }} products
                            </span>
                        </td>
                        <td class="text-muted">
                            <i class="bi bi-calendar me-1"></i>{{ $category->created_at->format('M d, Y') }}
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="{{ route('categories.show', $category) }}" class="btn btn-sm btn-outline-info" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                @if($category->products_count == 0)
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display: inline;" 
                                      onsubmit="return confirm('Are you sure you want to delete this category?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @else
                                <button class="btn btn-sm btn-outline-secondary" disabled title="Cannot delete - has products">
                                    <i class="bi bi-trash"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @if($categories->hasPages())
    <div class="card-footer bg-white">
        <div class="d-flex justify-content-center">
            {{ $categories->links() }}
        </div>
    </div>
    @endif
</div>
@else
<div class="card animate-fade-in">
    <div class="card-body">
        <div class="empty-state">
            <i class="bi bi-bookmark"></i>
            <h3>No Categories Found</h3>
            <p>Start by creating your first product category.</p>
            <a href="{{ route('categories.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i>Create First Category
            </a>
        </div>
    </div>
</div>
@endif
@endsection