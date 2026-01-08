<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SupplierController extends Controller
{
    public function index(): View
    {
        $suppliers = Supplier::withCount('products')->paginate(10);
        return view('suppliers.index', compact('suppliers'));
    }

    public function create(): View
    {
        return view('suppliers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers',
            'phone' => 'nullable|string',
            'address' => 'nullable|string'
        ]);

        Supplier::create($validated);
        return redirect()->route('suppliers.index')->with('success', 'Supplier added.');
    }

    public function show(Supplier $supplier): View
    {
        $supplier->load('products.category');
        return view('suppliers.show', compact('supplier'));
    }

    public function edit(Supplier $supplier): View
    {
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers,email,' . $supplier->id,
            'phone' => 'nullable|string',
            'address' => 'nullable|string'
        ]);

        $supplier->update($validated);
        return redirect()->route('suppliers.index')->with('success', 'Supplier updated.');
    }

    public function destroy(Supplier $supplier): RedirectResponse
    {
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Supplier removed.');
    }
}