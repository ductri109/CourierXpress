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
            // Thêm các cột mới cho địa chỉ người gửi
            $table->string('sender_province')->nullable()->after('sender_name');
            $table->string('sender_ward')->nullable()->after('sender_province');
            $table->string('sender_address_detail')->nullable()->after('sender_ward');

            // Thêm các cột mới cho địa chỉ người nhận
            $table->string('receiver_province')->nullable()->after('receiver_name');
            $table->string('receiver_ward')->nullable()->after('receiver_province');
            $table->string('receiver_address_detail')->nullable()->after('receiver_ward');

            // Thêm cột cho khoảng cân nặng và ghi chú
            $table->string('weight_range')->nullable()->after('total_weight');
            $table->text('shipping_notes')->nullable()->after('weight_range');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('couriers', function (Blueprint $table) {
            $table->dropColumn([
                'sender_province',
                'sender_ward',
                'sender_address_detail',
                'receiver_province',
                'receiver_ward',
                'receiver_address_detail',
                'weight_range',
                'shipping_notes'
            ]);
        });
    }
};
