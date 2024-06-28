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

            $table->foreignId('shop_id')->constrained('shops')->cascadeOnDelete();
            $table->foreignId('order_group_id')->constrained('order_groups')->cascadeOnDelete();
            $table->decimal('total_price', 10, 2);
            $table->decimal('delivery_charge', 10, 2);
            $table->string('coupon_id')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['new', 'processing', 'shipped', 'delivered', 'cancelled', 'refunded'])->default('new');
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
