<?php

namespace Database\Factories\Shop;

use App\Models\Shop\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop\ProductVariantAttribute>
 */
class ProductVariantAttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word,
            'price' => fake()->randomFloat(2, 5, 500),
            'product_variant_id' => ProductVariant::factory(),
        ];
    }
}
