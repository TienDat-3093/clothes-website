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
        Schema::table('comments', function (Blueprint $table) {
            $table->foreignId('users_id')->after('content')->constrained(
                table: 'users', indexName: 'comments_users_id'
            );
            $table->foreignId('products_id')->after('users_id')->constrained(
                table: 'products', indexName: 'comments_products_id'
            );
            $table->foreignId('status_id')->default(1)->after('products_id')->constrained(
                table: 'status', indexName: 'comments_status_id'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['users_id','products_id','status_id']);

            $table->dropColumn(['users_id','products_id','status_id']);
        });
    }
};
