<?php

namespace Database\Factories;

use App\Enums\DeliveryStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Test>
 */
class TestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'slug' => fake()->slug(),
            'phone' => fake()->phoneNumber(),
            'price' => fake()->randomFloat(2, 55, 409.99),
            'color' => fake()->hexColor(),
            'status' => fake()->randomElement(array_column(DeliveryStatus::cases(), 'value')),
            'description' => fake()->text(),
        ];
    }
}
