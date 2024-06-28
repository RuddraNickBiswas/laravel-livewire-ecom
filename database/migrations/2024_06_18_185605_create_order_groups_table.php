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
        Schema::create('order_groups', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->decimal('total_price', 10, 2);
            $table->decimal('total_delivery_charge', 10, 2);
            $table->unsignedBigInteger("delivery_district_id");
            $table->unsignedBigInteger("delivery_city_id");
            $table->string("delivery_address");
            $table->string('payment_method');
            $table->enum('payment_status', ['incomplete', 'completed', 'failed', 'refunded', 'verified'])->default('incomplete');
            $table->string('transaction_id')->nullable();
            $table->string('currency_code')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['new', 'processing', 'shipped', 'delivered', 'cancelled', 'refunded'])->default('new');
            $table->timestamp('payment_approve_date')->nullable();
            $table->timestamps();

            $table->foreign('delivery_district_id')->references('id')->on('order_districts');
            $table->foreign('delivery_city_id')->references('id')->on('order_cities');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_groups');
    }
};
