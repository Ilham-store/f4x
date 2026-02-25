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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->string('order_number')->unique();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('customer_name');
            $table->string('customer_phone');
            $table->text('delivery_address');

            $table->text('note')->nullable();

            $table->decimal('total_amount', 14, 2)->default(0);

            $table->enum('status', ['pending', 'paid', 'cancelled'])
                ->default('pending');
                
            $table->boolean('stock_adjusted')->default(false);
            $table->date('order_date');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
