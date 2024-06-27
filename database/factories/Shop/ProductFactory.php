<?php

namespace Database\Factories\Shop;

use App\Models\Shop\Category;
use App\Models\Shop\Brand;
use App\Models\Shop\Product;
use App\Models\Shop\ProductVariant;
use App\Models\Shop\ProductVariantAttribute;
use App\Models\Shop\Shop;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop\Product>
 */
class ProductFactory extends Factory
{
  /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generate a random date within the last 2 years
        $createdAt = $this->faker->dateTimeBetween('-1 years', 'now');

        return [
            'name' => fake()->text(100),
            'slug' => fake()->slug,
            'thumbnail' => fake()->imageUrl(1280, 720), // 16:9 ratio
            'user_id' => User::inRandomOrder()->first()->id,
            'brand_id' =>  Brand::inRandomOrder()->first()->id,
            'shop_id' =>  Shop::inRandomOrder()->first()->id,
            'qty' => fake()->numberBetween(1, 100),
            'sku' => fake()->slug,
            'description' => fake()->paragraph,
            'cost' => fake()->randomFloat(2, 3, 300),
            'price' => fake()->randomFloat(2, 10, 1000),
            'discounted_price' => fake()->optional()->randomFloat(2, 5, 500),
            'is_active' => fake()->boolean,
            'is_approved' => fake()->boolean,
            'seo_title' => fake()->sentence,
            'seo_description' => fake()->paragraph,
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }

    public function withLongDescription()
    {
        return $this->afterCreating(function (Product $product)
        {
            $product->longDescription()->create(['description' =>fake()->randomHtml()]);
        });
    }

    public function withCategories()
    {
        return $this->afterCreating(function (Product $product) {
            // Attach random selectable categories to the product
            $categories = Category::selectable()->inRandomOrder()->take(rand(1, 5))->pluck('id');
            $product->categories()->attach($categories);
        });
    }

    public function withVariants()
    {
        return $this->afterCreating(function (Product $product) {
            // Create 1-3 variants
            $variants = ProductVariant::factory()->count(rand(1, 3))->create(['product_id' => $product->id]);

            // For each variant, create 2-4 attributes
            $variants->each(function ($variant) {
                ProductVariantAttribute::factory()->count(rand(2, 4))->create(['product_variant_id' => $variant->id]);
            });
        });
    }
}
