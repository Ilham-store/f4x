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
            $table->decimal('additional_cost', 15, 2)->default(0);
            $table->decimal('discount', 15, 2)->default(0);

            $table->decimal('subtotal', 15, 2)->default(0);
            $table->decimal('grand_total', 15, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_form_requests', function (Blueprint $table) {
            $table->decimal('additional_cost', 15, 2)->default(0);
            $table->decimal('discount', 15, 2)->default(0);
            $table->decimal('subtotal', 15, 2)->default(0);
            $table->decimal('grand_total', 15, 2)->default(0);
        });
    }
};
