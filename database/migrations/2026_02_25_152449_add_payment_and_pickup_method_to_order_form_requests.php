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
        Schema::table('order_form_requests', function (Blueprint $table) {
            $table->enum('payment_method', ['cash', 'transfer'])
                  ->nullable()
                  ->after('customer_instagram');

            $table->enum('pickup_method', ['courier', 'self_pickup'])
                  ->nullable()
                  ->after('payment_method');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_form_requests', function (Blueprint $table) {
            $table->dropColumn([
                'payment_method',
                'pickup_method',
            ]);
        });
    }
};
