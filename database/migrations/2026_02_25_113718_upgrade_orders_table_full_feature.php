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
        Schema::table('orders', function (Blueprint $table) {

            // === CUSTOMER EXTRA INFO ===
            $table->string('customer_instagram')->nullable()->after('customer_phone');
    
            // === PAYMENT & PICKUP ===
            $table->enum('payment_method', ['transfer', 'cash'])
                  ->default('transfer')
                  ->after('status');
    
            $table->enum('pickup_method', ['self_pickup', 'courier'])
                  ->default('self_pickup')
                  ->after('payment_method');
    
            $table->date('pickup_date')->nullable()->after('pickup_method');
            $table->time('pickup_time')->nullable()->after('pickup_date');
    
            // === GREETING ===
            $table->text('greeting_card')->nullable()->after('pickup_time');
            $table->text('balloon_message')->nullable()->after('greeting_card');
    
            // === FINANCIAL ===
            $table->decimal('extra_cost', 14, 2)->default(0)->after('total_amount');
    
            $table->enum('discount_type', ['percent', 'nominal'])
                  ->nullable()
                  ->after('extra_cost');
    
            $table->decimal('discount_value', 14, 2)
                  ->default(0)
                  ->after('discount_type');
    
            $table->decimal('grand_total', 14, 2)
                  ->default(0)
                  ->after('discount_value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
