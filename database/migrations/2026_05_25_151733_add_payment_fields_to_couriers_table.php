<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('couriers', 'shipping_fee')) {
            Schema::table('couriers', function (Blueprint $table) {
                $table->decimal('shipping_fee', 12, 2)->default(0)->after('total_weight');
            });
        }

        if (!Schema::hasColumn('couriers', 'cod_amount')) {
            Schema::table('couriers', function (Blueprint $table) {
                $table->decimal('cod_amount', 12, 2)->default(0)->after('shipping_fee');
            });
        }

        if (!Schema::hasColumn('couriers', 'payment_method')) {
            Schema::table('couriers', function (Blueprint $table) {
                $table->string('payment_method', 50)->default('cod')->after('cod_amount');
            });
        }

        if (!Schema::hasColumn('couriers', 'payment_status')) {
            Schema::table('couriers', function (Blueprint $table) {
                $table->string('payment_status', 50)->default('unpaid')->after('payment_method');
            });
        }

        DB::table('couriers')
            ->where(function ($query) {
                $query->whereNull('shipping_fee')
                    ->orWhere('shipping_fee', 0)
                    ->orWhereNull('cod_amount')
                    ->orWhere('cod_amount', 0);
            })
            ->update([
                'shipping_fee' => DB::raw('30000 + (total_weight * 10000)'),
                'cod_amount' => DB::raw('30000 + (total_weight * 10000)'),
                'payment_method' => 'cod',
                'payment_status' => 'unpaid',
            ]);
    }

    public function down(): void
    {
        Schema::table('couriers', function (Blueprint $table) {
            if (Schema::hasColumn('couriers', 'payment_status')) {
                $table->dropColumn('payment_status');
            }

            if (Schema::hasColumn('couriers', 'payment_method')) {
                $table->dropColumn('payment_method');
            }

            if (Schema::hasColumn('couriers', 'cod_amount')) {
                $table->dropColumn('cod_amount');
            }

            if (Schema::hasColumn('couriers', 'shipping_fee')) {
                $table->dropColumn('shipping_fee');
            }
        });
    }
};
