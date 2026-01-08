<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Product;

class InventorySeeder extends Seeder
{
    public function run(): void
    {
        // categories
        $hardware = Category::create([
            'name' => 'Hardware',
            'description' => 'Computer parts and accessories'
        ]);

        $office = Category::create([
            'name' => 'Office Supplies',
            'description' => 'General office stuff'
        ]);

        $networking = Category::create([
            'name' => 'Networking',
            'description' => 'Routers, switches, cables etc'
        ]);

        // suppliers - using some local ones for testing
        $mainSupplier = Supplier::create([
            'name' => 'PT Maju Jaya',
            'email' => 'order@majujaya.co.id',
            'phone' => '021-5550123',
            'address' => 'Jl. Mangga Dua Raya No. 45, Jakarta'
        ]);

        $backupSupplier = Supplier::create([
            'name' => 'CV Berkah Sentosa',
            'email' => 'sales@berkahsentosa.com',
            'phone' => '021-5550456',
            'address' => 'Ruko Glodok Plaza Blok C-12'
        ]);

        $importSupplier = Supplier::create([
            'name' => 'Global Tech Trading',
            'email' => 'info@globaltechtrading.com',
            'phone' => '+65-91234567',
            'address' => '50 Raffles Place, Singapore'
        ]);

        // Products - mix of stock levels to test alerts
        Product::create([
            'name' => 'Logitech M331 Mouse',
            'description' => 'Silent wireless mouse, good for office use',
            'sku' => 'LOG-M331',
            'price' => 285000,
            'quantity_in_stock' => 45,
            'minimum_stock_level' => 10,
            'category_id' => $hardware->id,
            'supplier_id' => $mainSupplier->id
        ]);

        Product::create([
            'name' => 'TP-Link TL-SG108 Switch',
            'description' => '8 port gigabit switch',
            'sku' => 'TPL-SG108',
            'price' => 450000,
            'quantity_in_stock' => 5, // low stock
            'minimum_stock_level' => 8,
            'category_id' => $networking->id,
            'supplier_id' => $backupSupplier->id
        ]);

        Product::create([
            'name' => 'A4 Paper (1 Rim)',
            'description' => 'Standard 70gsm',
            'sku' => 'OFF-A4-70',
            'price' => 52000,
            'quantity_in_stock' => 120,
            'minimum_stock_level' => 20,
            'category_id' => $office->id,
            'supplier_id' => $mainSupplier->id
        ]);

        Product::create([
            'name' => 'Cat6 Cable 305m Box',
            'description' => 'UTP Cat6 blue, for new office setup',
            'sku' => 'NET-CAT6-305',
            'price' => 1850000,
            'quantity_in_stock' => 0, // out of stock!
            'minimum_stock_level' => 2,
            'category_id' => $networking->id,
            'supplier_id' => $importSupplier->id
        ]);

        Product::create([
            'name' => 'Kingston 16GB DDR4 RAM',
            'description' => '3200MHz, for workstation upgrades',
            'sku' => 'KNG-DDR4-16',
            'price' => 725000,
            'quantity_in_stock' => 12,
            'minimum_stock_level' => 5,
            'category_id' => $hardware->id,
            'supplier_id' => $importSupplier->id
        ]);
    }
}