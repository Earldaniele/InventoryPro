<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\InventoryTransaction;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // quick counts for the dashboard cards
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalSuppliers = Supplier::count();
        $lowStockProducts = Product::whereColumn('quantity_in_stock', '<=', 'minimum_stock_level')->count();
        
        $recentTransactions = InventoryTransaction::with('product')
            ->latest()
            ->take(10)
            ->get();
        
        // just grab first 5 low stock items for the dashboard widget
        $lowStockItems = Product::with(['category', 'supplier'])
            ->whereColumn('quantity_in_stock', '<=', 'minimum_stock_level')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalProducts',
            'totalCategories', 
            'totalSuppliers',
            'lowStockProducts',
            'recentTransactions',
            'lowStockItems'
        ));
    }
}