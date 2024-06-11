<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            'Amazon',
            'eBay',
            'Alibaba',
            'Walmart',
            'Rakuten',
            'Etsy',
            'Target',
            'Best Buy',
            'Newegg',
            'Shopify',
            'Zalando',
            'ASOS',
            'Overstock',
            'Wayfair',
            'Flipkart',
        ];

        foreach ($brands as $brand) {
            Brand::create([
                'name' => $brand,
                'slug' => Str::slug($brand),
                'is_active' => (bool) random_int(0, 1),
                'thumbnail' => 'https://logopond.com/logos/db69b8933f043810f3c4462c73585954.png'
            ]);
        }
    }

}
