@extends('layouts.app')

@section('title', 'Suppliers - Inventory Management System')

@section('breadcrumb', 'Suppliers')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-truck me-2 text-info"></i>Suppliers</h1>
    <div class="d-flex gap-2">
        <a href="{{ route('suppliers.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i>Add Supplier
        </a>
    </div>
</div>

@if($suppliers->count() > 0)
<div class="card animate-fade-in">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-list-ul me-2"></i>All Suppliers</span>
        <span class="badge bg-info">{{ $suppliers->total() }} suppliers</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Supplier Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Products</th>
                        <th>Created</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($suppliers as $supplier)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-info bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="bi bi-building text-info"></i>
                                </div>
                                <span class="fw-medium">{{ $supplier->name }}</span>
                            </div>
                        </td>
                        <td>
                            <a href="mailto:{{ $supplier->email }}" class="text-decoration-none">
                                <i class="bi bi-envelope me-1"></i>{{ $supplier->email }}
                            </a>
                        </td>
                        <td class="text-muted">
                            @if($supplier->phone)
                                <i class="bi bi-telephone me-1"></i>{{ $supplier->phone }}
                            @else
                                <span class="text-muted fst-italic">Not provided</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-primary rounded-pill">
                                <i class="bi bi-box me-1"></i>{{ $supplier->products_count }} products
                            </span>
                        </td>
                        <td class="text-muted">
                            <i class="bi bi-calendar me-1"></i>{{ $supplier->created_at->format('M d, Y') }}
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="{{ route('suppliers.show', $supplier) }}" class="btn btn-sm btn-outline-info" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                @if($supplier->products_count == 0)
                                <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" style="display: inline;" 
                                      onsubmit="return confirm('Are you sure you want to delete this supplier?')">
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
    @if($suppliers->hasPages())
    <div class="card-footer bg-white">
        <div class="d-flex justify-content-center">
            {{ $suppliers->links() }}
        </div>
    </div>
    @endif
</div>
@else
<div class="card animate-fade-in">
    <div class="card-body">
        <div class="empty-state">
            <i class="bi bi-truck"></i>
            <h3>No Suppliers Found</h3>
            <p>Start by adding your first supplier.</p>
            <a href="{{ route('suppliers.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i>Add First Supplier
            </a>
        </div>
    </div>
</div>
@endif
@endsection