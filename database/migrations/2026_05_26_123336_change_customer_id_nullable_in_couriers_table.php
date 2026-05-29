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
        Schema::table('couriers', function (Blueprint $table) {
            // Thay đổi cột customer_id thành nullable() để chấp nhận giá trị null
            $table->foreignId('customer_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('couriers', function (Blueprint $table) {
            // Trở lại trạng thái cũ nếu cần rollback (bỏ nullable)
            $table->foreignId('customer_id')->nullable(false)->change();
        });
    }
};
