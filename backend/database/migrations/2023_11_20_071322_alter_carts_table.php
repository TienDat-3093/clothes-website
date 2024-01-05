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
        Schema::table('carts', function (Blueprint $table) {
            $table->foreignId('users_id')->constrained(
                table: 'users',
                indexName: 'carts_users_id'
            );
            $table->foreignId('discounts_id')->nullable()->constrained(
                table: 'discounts',
                indexName: 'cart_details_discounts_id'
            );
            $table->foreignId('status_id')->default(1)->constrained(
                table: 'status',
                indexName: 'carts_status_id'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropForeign(['admins_id', 'users_id', 'status_id']);

            $table->dropColumn(['admins_id', 'users_id', 'status_id']);
        });
    }
};
