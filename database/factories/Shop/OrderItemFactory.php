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
        return [
            'order_id' => null, // This will be set in the afterCreating method of OrderGroupFactory
            'product_id' => null, // This will be set in the afterCreating method of OrderGroupFactory
            'total_price' => 0, // This will be set based on the product price
            'unit_price' => 0, // This will be set based on the product price
            'qty' => $this->faker->numberBetween(1, 10),
            'options' => null,
        ];
    }
}
