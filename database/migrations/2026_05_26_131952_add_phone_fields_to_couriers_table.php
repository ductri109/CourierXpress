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
            // Thêm trường số điện thoại người gửi và người nhận (cho phép null nếu chưa có)
            $table->string('sender_phone', 20)->nullable()->after('id');
            $table->string('receiver_phone', 20)->nullable()->after('sender_phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('couriers', function (Blueprint $table) {
            // Xóa cột nếu rollback
            $table->dropColumn(['sender_phone', 'receiver_phone']);
        });
    }
};
