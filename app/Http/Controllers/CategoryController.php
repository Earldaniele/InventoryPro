<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::withCount('products')->paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        Category::create($validated);
        return redirect()->route('categories.index')->with('success', 'Category created.');
    }

    public function show(Category $category): View
    {
        $category->load('products.supplier');
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category): View
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $category->update($validated);
        return redirect()->route('categories.index')->with('success', 'Category updated.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        // TODO: should probably check if category has products before deleting
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted.');
    }
}