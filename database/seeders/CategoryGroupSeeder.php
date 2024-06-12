<?php

namespace Database\Seeders;

use App\Models\CategoryGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryGroups = [
            ['name' => 'Electronics', 'slug' => 'electronics'],
            ['name' => 'Home & Kitchen', 'slug' => 'home-kitchen'],
            ['name' => 'Fashion', 'slug' => 'fashion'],
            ['name' => 'Health & Beauty', 'slug' => 'health-beauty'],
            ['name' => 'Sports & Outdoors', 'slug' => 'sports-outdoors'],
            ['name' => 'Toys & Games', 'slug' => 'toys-games'],
        ];

        foreach ($categoryGroups as $group) {
            CategoryGroup::create($group);
        }
    }
}
