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
        Schema::table('imports', function (Blueprint $table) {
            $table->foreignId('admins_id')->after('total_price')->constrained(
                table: 'admins', indexName: 'imports_admins_id'
            );
            $table->foreignId('suppliers_id')->after('admins_id')->constrained(
                table: 'suppliers', indexName: 'imports_users_id'
            );
            $table->foreignId('status_id')->default(1)->after('suppliers_id')->constrained(
                table: 'status', indexName: 'imports_status_id'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('imports', function (Blueprint $table) {
            $table->dropForeign(['admins_id','suppliers_id','status_id']);

            $table->dropColumn(['admins_id','suppliers_id','status_id']);
        });
    }
};
