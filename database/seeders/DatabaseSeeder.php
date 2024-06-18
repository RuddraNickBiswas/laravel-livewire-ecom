<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Shop\Product;
use App\Models\Test;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'User',
            'email' => 'user@example.com',
        ]);
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => 'admin'
        ]);

        $this->call([
            BrandSeeder::class,
            CategoryGroupSeeder::class,
            CategorySeeder::class,
        ]);

        // Check if categories are seeded correctly
        Product::factory()->withCategories()->withVariants()->count(50)->create();
        // Check if categories are seeded correctly
        if (Category::count() > 0) {
            Test::factory(9)->create();
        } else {
            $this->command->info('No categories found! Make sure CategorySeeder is working.');
        }
    }
}
