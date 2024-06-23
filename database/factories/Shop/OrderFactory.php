<?php

namespace Database\Factories\Shop;

use App\Models\Shop\Order;
use App\Models\Shop\OrderCity;
use App\Models\Shop\OrderDistrict;
use App\Models\Shop\OrderItem;
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
    public function definition(): array
    {
        // Generate a random date within the last 2 years
        $createdAt = fake()->dateTimeBetween('-1 years', 'now');
        $user = User::inRandomOrder()->first();
        $orderDistrict = OrderDistrict::inRandomOrder()->first();
        $orderCity = $orderDistrict->orderCities()->inRandomOrder()->first();
        return [
            'invoice_id' => generateInvoiceId(),
            'name' => fake()->name,
            'email' => fake()->unique()->safeEmail,
            'phone' => fake()->phoneNumber,
            'user_id' => $user->id,
            'total_price' => 0.00, // This will be calculated
            'delivery_charge' => 0.00, // This will be calculated
            'delivery_district_id' => $orderDistrict->id,
            'status' => fake()->randomElement(['new', 'processing', 'shipped', 'delivered', 'cancelled', 'refunded']),
            'delivery_city_id' => $orderCity->id,
            'delivery_address' => fake()->address,
            'payment_method' => fake()->randomElement(['credit_card', 'paypal', 'bank_transfer']),
            'payment_status' => fake()->randomElement(['incomplete', 'completed', 'failed', 'refunded', 'verified']),
            'transaction_id' => null,
            'coupon_id' => null,
            'currency_code' => 'USD',
            'payment_approve_date' => null,
            'notes' => fake()->text(200),
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Order $order) {
            $orderItems = OrderItem::factory()->count(rand(1, 5))->create(['order_id' => $order->id]);

            $totalQty = 0;
            $totalPrice = 0.0;

            foreach ($orderItems as $item) {
                $totalQty += $item->qty;
                $totalPrice += $item->unit_price * $item->qty;
            }

            $deliveryCharge = OrderCity::find($order->delivery_city_id)->delivery_charge;

            $order->update([
                'total_price' => $totalPrice,
                'delivery_charge' => $deliveryCharge,
            ]);
        });
    }
}
