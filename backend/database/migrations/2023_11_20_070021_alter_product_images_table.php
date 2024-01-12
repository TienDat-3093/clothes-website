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
        Schema::table('product_images', function (Blueprint $table) {
            $table->foreignId('products_id')->after('url')->constrained(
                table: 'products', indexName: 'product_images_products_id'
            );
           
            $table->foreignId('status_id')->default(1)->after('products_id')->constrained(
                table: 'status', indexName: 'product_images_status_id'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_images', function (Blueprint $table) {
            $table->dropForeign(['products_id','status_id']);

            $table->dropColumn(['products_id','status_id']);
        });
    }
};
