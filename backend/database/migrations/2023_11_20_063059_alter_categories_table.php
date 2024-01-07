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
            $table->foreignId('product_types_id')->after('name')->constrained(
                table: 'product_types', indexName: 'categories_product_types_id'
            );
            $table->foreignId('status_id')->default(1)->after('product_types_id')->constrained(
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
            $table->dropForeign(['product_types_id','status_id']);

            $table->dropColumn(['product_types_id','status_id']);

        });
    }
};
