<?php

namespace Database\Factories\Shop;

use App\Models\Shop\Order;
use App\Models\Shop\OrderItem;
use App\Models\Shop\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = OrderItem::class;

    public function definition()
    {
        // Select a random product
        $product = Product::inRandomOrder()->first();
        $unitPrice = $product->discounted_price ?? $product->price;

        return [
            'name' => $product->name,
            'order_id' => Order::factory(),
            'product_id' => $product->id,
            'unit_price' => $unitPrice,
            'qty' => $this->faker->numberBetween(1, 10),
            'options' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
