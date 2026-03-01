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
        Schema::create('order_form_requests', function (Blueprint $table) {
            $table->id();

            $table->string('token')->unique();

            $table->foreignId('product_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('customer_instagram')->nullable();

            $table->text('delivery_address')->nullable();
            $table->text('note')->nullable();

            $table->date('pickup_date')->nullable();
            $table->time('pickup_time')->nullable();

            $table->text('greeting_card')->nullable();
            $table->text('balloon_message')->nullable();

            $table->enum('status', [
                'pending',
                'submitted',
                'converted',
                'cancelled'
            ])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_form_requests');
    }
};
