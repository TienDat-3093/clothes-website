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
        Schema::table('categories', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained(
                table: 'products', indexName: 'categories_products_id'
            );
            $table->foreignId('status_id')->constrained(
                table: 'status', indexName: 'categories_status_id'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign(['status_id']);

            $table->dropColumn(['status_id']);

        });
    }
};
