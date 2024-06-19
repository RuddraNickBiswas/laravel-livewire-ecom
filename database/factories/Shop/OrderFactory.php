<?php

namespace Database\Factories\Shop;

use App\Models\Shop\Order;
use App\Models\Shop\OrderCity;
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
           $createdAt = fake()->dateTimeBetween('-2 years', 'now');
           $user = User::inRandomOrder()->first();
           $orderCity = OrderCity::inRandomOrder()->first();
        return [
            'invoice_id' => generateInvoiceId(),
            'name' => fake()->name,
            'email' => fake()->unique()->safeEmail,
            'phone' => fake()->phoneNumber,
            'user_id' => $user->id,
            'qty' => 0, // This will be updated in the logic
            'total_price' => 0.00, // This will be calculated
            'delivery_charge' => 0.00, // This will be calculated
            'delivery_city_id' => $orderCity->id,
            'delivery_address' => $this->faker->address,
            'payment_method' => $this->faker->randomElement(['credit_card', 'paypal', 'bank_transfer']),
            'payment_status' => 'incomplete',
            'transaction_id' => null,
            'coupon_id' => null,
            'currency_code' => 'USD',
            'status' => 'pending',
            'payment_approve_date' => null,
            'created_at' =>$createdAt,
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
                'qty' => $totalQty,
                'total_price' => $totalPrice,
                'delivery_charge' => $deliveryCharge,
            ]);
        });
    }
}
