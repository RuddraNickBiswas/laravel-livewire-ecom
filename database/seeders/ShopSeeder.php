<?php

namespace Database\Seeders;

use App\Models\Shop\Shop;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shops = [
            [
                'name' => 'Tech Haven',
                'user_id' => 1,
            ],
            [
                'name' => 'Fashion Fiesta',
                'user_id' => 2,
            ],
            [
                'name' => 'Gadget Galaxy',
                'user_id' => 3,
            ],
        ];

        // Create shops and attach them to the corresponding users
        foreach ($shops as $shopData) {
            $shop = Shop::create([
                'name' => $shopData['name'],
                'slug' => Str::slug($shopData['name']),
            ]);

            // Attach the shop to the user
            $user = User::find($shopData['user_id']);
            $user?->shops()->attach($shop->id);
//            $shop->appearance()->create();
        }
    }
}
