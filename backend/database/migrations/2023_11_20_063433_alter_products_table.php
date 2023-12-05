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
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('categories_id')->after('star_avg')->constrained(
                table: 'categories', indexName: 'products_categories_id'
            );
            $table->foreignId('status_id')->default(1)->after('categories_id')->constrained(
                table: 'status', indexName: 'products_status_id'
            );
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['categories_id','status_id']);

            $table->dropColumn(['categories_id','status_id']);
        });
    }
};
