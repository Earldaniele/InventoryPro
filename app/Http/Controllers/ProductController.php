<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Services\InventoryDSSService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    protected $dssService;

    public function __construct(InventoryDSSService $dssService)
    {
        $this->dssService = $dssService;
    }

    public function index(): View
    {
        $products = Product::with(['category', 'supplier'])->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create(): View
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('products.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sku' => 'required|string|unique:products',
            'price' => 'required|numeric|min:0',
            'unit_cost' => 'nullable|numeric|min:0',
            'quantity_in_stock' => 'required|integer|min:0',
            'minimum_stock_level' => 'required|integer|min:0',
            'reorder_quantity' => 'nullable|integer|min:0',
            'safety_stock' => 'nullable|integer|min:0',
            'priority' => 'nullable|in:critical,high,medium,low',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id'
        ]);

        // defaults if not provided
        $validated['unit_cost'] = $validated['unit_cost'] ?? ($validated['price'] * 0.6);
        $validated['safety_stock'] = $validated['safety_stock'] ?? 0;
        $validated['priority'] = $validated['priority'] ?? 'medium';

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Product created.');
    }

    public function show(Product $product): View
    {
        $product->load(['category', 'supplier', 'inventoryTransactions']);
        
        $dssMetrics = $this->dssService->calculateProductMetrics($product);
        $chartData = $this->dssService->getConsumptionChartData($product, 30);
        
        return view('products.show', compact('product', 'dssMetrics', 'chartData'));
    }

    public function edit(Product $product): View
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sku' => 'required|string|unique:products,sku,' . $product->id,
            'price' => 'required|numeric|min:0',
            'unit_cost' => 'nullable|numeric|min:0',
            'quantity_in_stock' => 'required|integer|min:0',
            'minimum_stock_level' => 'required|integer|min:0',
            'reorder_quantity' => 'nullable|integer|min:0',
            'safety_stock' => 'nullable|integer|min:0',
            'priority' => 'nullable|in:critical,high,medium,low',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id'
        ]);

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted.');
    }

    // DSS-powered low stock page
    public function lowStock(): View
    {
        $dssData = $this->dssService->getLowStockWithDSS();
        $summary = $this->dssService->getReorderSummary($dssData);
        
        return view('products.low-stock-dss', compact('dssData', 'summary'));
    }
}