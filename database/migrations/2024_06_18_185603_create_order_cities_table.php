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
        Schema::create('order_cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('delivery_charge', 8, 2)->default(0.00);
            $table->foreignId('order_district_id')
                ->constrained('order_districts')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_cities');
    }
};
