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
        Schema::table('import_details', function (Blueprint $table) {
            $table->foreignId('imports_id')->after('price')->constrained(
                table: 'imports', indexName: 'import_details_imports_id'
            );
            $table->foreignId('products_id')->after('imports_id')->constrained(
                table: 'products', indexName: 'import_details_products_id'
            );
            $table->foreignId('discounts_id')->after('products_id')->constrained(
                table: 'discounts', indexName: 'import_details_discounts_id'
            );
            $table->foreignId('status_id')->default(1)->after('discounts_id')->constrained(
                table: 'status', indexName: 'import_details_status_id'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('import_details', function (Blueprint $table) {
            $table->dropForeign(['imports_id','products_id','discounts_id','status_id']);

            $table->dropColumn(['imports_id','products_id','discounts_id','status_id']);
        });
    }
};
