<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Add DSS fields to products table
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('unit_cost', 10, 2)->default(0)->after('price'); // Cost price for profit analysis
            $table->decimal('holding_cost_percent', 5, 2)->default(20)->after('unit_cost'); // Annual holding cost as % of unit cost
            $table->integer('reorder_quantity')->nullable()->after('minimum_stock_level'); // Default reorder qty
            $table->integer('safety_stock')->default(0)->after('reorder_quantity'); // Safety buffer stock
            $table->enum('priority', ['critical', 'high', 'medium', 'low'])->default('medium')->after('safety_stock');
        });

        // Add DSS fields to suppliers table
        Schema::table('suppliers', function (Blueprint $table) {
            $table->integer('lead_time_days')->default(7)->after('address'); // Days to deliver
            $table->decimal('reliability_score', 3, 2)->default(0.90)->after('lead_time_days'); // 0-1 reliability rating
            $table->decimal('minimum_order_value', 10, 2)->default(0)->after('reliability_score');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['unit_cost', 'holding_cost_percent', 'reorder_quantity', 'safety_stock', 'priority']);
        });

        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropColumn(['lead_time_days', 'reliability_score', 'minimum_order_value']);
        });
    }
};
