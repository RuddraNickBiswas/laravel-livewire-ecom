<?php

namespace Database\Factories\Shop;

use App\Models\Shop\Order;
use App\Models\Shop\OrderCity;
use App\Models\Shop\OrderDistrict;
use App\Models\Shop\OrderItem;
use App\Models\Shop\Shop;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Order::class;

    public function definition()
    {
        return [
            'shop_id' => 1,// This will be calculated later
            'total_price' => 0, // This will be calculated later
            'delivery_charge' => $this->faker->randomFloat(2, 5, 20),
            'coupon_id' => null,
            'notes' => $this->faker->paragraph,
            'status' => 'new',
        ];
    }
}
