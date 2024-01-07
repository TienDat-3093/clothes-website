<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cart_details', function (Blueprint $table) {
            $table->foreignId('carts_id')->after('price')->constrained(
                table: 'carts',
                indexName: 'cart_details_carts_id'
            );
            $table->foreignId('products_id')->after('carts_id')->constrained(
                table: 'products',
                indexName: 'cart_details_products_id'
            );
            $table->foreignId('colors_id')->constrained(
                table: 'colors',
                indexName: 'cart_details_colors_id'
            );
            $table->foreignId('sizes_id')->constrained(
                table: 'sizes',
                indexName: 'cart_details_sizes_id'
            );
            $table->foreignId('status_id')->default(1)->constrained(
                table: 'status',
                indexName: 'cart_details_status_id'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cart_details', function (Blueprint $table) {
            $table->dropForeign(['carts_id', 'products_id', 'discounts_id', 'status_id']);

            $table->dropColumn(['carts_id', 'products_id', 'discounts_id', 'status_id']);
        });
    }
};
