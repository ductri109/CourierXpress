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
        Schema::create('couriers', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_id')->unique(); // IDTracking
            $table->string('sender_name');
            $table->string('sender_address');
            $table->string('sender_phone');
            $table->string('receiver_name');
            $table->string('receiver_address');
            $table->string('receiver_phone');
            $table->float('total_weight');
            $table->string('status')->default('pending');
            $table->foreignId('customer_id')->nullable()->constrained('customers');
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->foreign('agent_id')->references('ID')->on('agents')->onDelete('set null');
            $table->timestamps();
            $table->decimal('shipping_fee', 12, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('couriers');
    }
};
