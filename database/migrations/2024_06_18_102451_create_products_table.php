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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('thumbnail');
            $table->foreignId('brand_id')->nullable()->constrained('brands')->cascadeOnDelete();
            $table->foreignId('shop_id')->constrained('brands')->cascadeOnDelete();
            $table->integer('qty');
            $table->string('sku');
            $table->text('description');
            $table->double('cost');
            $table->double('price');
            $table->double('discounted_price')->nullable();
            $table->boolean('is_active')->default(false);
            $table->boolean('is_approved')->default(false);
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->softDeletes('deleted_at', precision: 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
