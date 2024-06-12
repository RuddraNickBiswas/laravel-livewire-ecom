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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('phone');
            $table->string('color')->nullable();
            $table->decimal('price', total: 8, places: 2);
            $table->string('thumbnail')->nullable();
            $table->string('description');
            $table->enum('status', ['pending', 'approve', 'rejected', 'delivered'])->default('pending');
            $table->boolean('is_published')->default(false);
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
