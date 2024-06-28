<?php

namespace Database\Factories\Shop;

use App\Models\Shop\Order;
use App\Models\Shop\OrderCity;
use App\Models\Shop\OrderDistrict;
use App\Models\Shop\OrderGroup;
use App\Models\Shop\OrderItem;
use App\Models\Shop\Product;
use App\Models\Shop\Shop;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop\OrderGroup>
 */
class OrderGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = OrderGroup::class;

    public function definition()
    {
        $createdAt = $this->faker->dateTimeBetween('-1 years', 'now');

        return [
            'invoice_id' => $this->faker->unique()->numerify('INV-#####'),
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'user_id' => User::inRandomOrder()->first()->id,
            'total_price' => 0, // This will be calculated later
            'total_delivery_charge' => 0, // This will be calculated later
            'delivery_district_id' => OrderDistrict::inRandomOrder()->first()->id,
            'delivery_city_id' => OrderCity::inRandomOrder()->first()->id,
            'delivery_address' => $this->faker->address,
            'payment_method' => $this->faker->randomElement(['credit_card', 'paypal', 'bank_transfer']),
            'payment_status' => 'incomplete',
            'transaction_id' => null,
            'currency_code' => 'USD',
            'notes' => $this->faker->paragraph,
            'status' => 'new',
            'payment_approve_date' => null,
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (OrderGroup $orderGroup) {
            $totalPrice = 0;
            $totalDeliveryCharge = 0;

            $orders = Order::factory([
                'delivery_charge' => $orderGroup->deliveryCity->delivery_charge,
                'created_at' => $orderGroup->created_at,
                'updated_at' => $orderGroup->updated_at,
            ])
                ->count(rand(1, 3))
                ->make();

            foreach ($orders as $order) {
                //ensure that shop has product before execute
                $shop = Shop::whereHas('products')->inRandomOrder()->first();
                $order->shop_id = $shop->id;
                $order->order_group_id = $orderGroup->id;
                $order->save();

                $orderItems = OrderItem::factory([
                    'created_at' => $orderGroup->created_at,
                    'updated_at' => $orderGroup->updated_at,
                ])
                    ->count(rand(1, 4))
                    ->make();

                $orderTotalPrice = 0;

                foreach ($orderItems as $orderItem) {
                    $product = Product::where('shop_id', $shop->id)->inRandomOrder()->first();

                    // Calculate unit price (considering discounted price if available)
                    $unitPrice = $product->discounted_price ?? $product->price;

                    // Example: Fetch a product variant and its attribute
                    $productVariant = $product->variants()->inRandomOrder()->first();
                    $productVariantAttribute = $productVariant->attributes()->inRandomOrder()->first();

                    // Calculate total price based on options (e.g., variants with prices)
                    $options = [
                        [
                            'variant_name' => $productVariant->name,
                            'variant_attribute_name' => $productVariantAttribute->name,
                            'price' => $productVariantAttribute->price,
                        ]
                    ];

                    // Save order item details
                    $orderItem->product_id = $product->id;
                    $orderItem->unit_price = $unitPrice;
                    $orderItem->order_id = $order->id;
                    $orderItem->options = $options;
                    $orderItem->total_price = $unitPrice + $productVariantAttribute->price; // Calculate total price
                    $orderItem->save();

                    // Calculate order item total price based on quantity
                    $orderTotalPrice += $orderItem->total_price * $orderItem->qty;
                }

                // Update order total price including delivery charge
                $order->total_price = $orderTotalPrice + $order->delivery_charge;
                $order->save();

                // Accumulate total price and delivery charge for the order group
                $totalPrice += $orderTotalPrice;
                $totalDeliveryCharge += $order->delivery_charge;
            }

            // Update order group total price and delivery charge
            $orderGroup->total_price = $totalPrice + $totalDeliveryCharge;
            $orderGroup->total_delivery_charge = $totalDeliveryCharge;
            $orderGroup->save();
        });
    }
}
