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
            $table->string('invoice_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->integer('qty');
            $table->decimal('total_price', 10, 2);
            $table->decimal('delivery_charge', 10, 2);
            $table->unsignedBigInteger("delivery_city_id");
            $table->string("delivery_address");
            $table->string('payment_method');
            $table->string('payment_status')->default('incomplete');
            $table->string('transaction_id')->nullable();
            $table->string('coupon_id')->nullable();
            $table->string('currency_code')->nullable();
            $table->enum('status', ['pending', 'processing', 'shipped', 'delivered', 'cancelled', 'on_hold', 'refunded'])->default('pending');
            $table->timestamp('payment_approve_date')->nullable();
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
