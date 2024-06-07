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
            [
                'name' => 'Electronics',
                'slug' => 'electronics',
                'categories' => [
                    [
                        'name' => 'TVs',
                        'slug' => 'tvs',
                        'sub_categories' => [
                            [
                                'name' => 'LED TVs',
                                'slug' => 'led-tvs',
                            ],
                            [
                                'name' => 'OLED TVs',
                                'slug' => 'oled-tvs',
                            ],
                        ],
                    ],
                    [
                        'name' => 'Laptops',
                        'slug' => 'laptops',
                        'sub_categories' => [
                            [
                                'name' => 'Gaming Laptops',
                                'slug' => 'gaming-laptops',
                            ],
                            [
                                'name' => 'Workstations',
                                'slug' => 'workstations',
                            ],
                        ],
                    ],
                    [
                        'name' => 'Smartphones',
                        'slug' => 'smartphones',
                        'sub_categories' => [
                            [
                                'name' => 'Android Phones',
                                'slug' => 'android-phones',
                            ],
                            [
                                'name' => 'iOS Phones',
                                'slug' => 'ios-phones',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Clothing',
                'slug' => 'clothing',
                'categories' => [
                    [
                        'name' => 'Men\'s Clothing',
                        'slug' => 'mens-clothing',
                        'sub_categories' => [
                            [
                                'name' => 'Shirts',
                                'slug' => 'shirts',
                            ],
                            [
                                'name' => 'Pants',
                                'slug' => 'pants',
                            ],
                        ],
                    ],
                    [
                        'name' => 'Women\'s Clothing',
                        'slug' => 'womens-clothing',
                        'sub_categories' => [
                            [
                                'name' => 'Dresses',
                                'slug' => 'dresses',
                            ],
                            [
                                'name' => 'Jeans',
                                'slug' => 'jeans',
                            ],
                        ],
                    ],
                ],
            ],
        ];

        foreach ($categoryGroups as $groupData) {
            $categoryGroup = CategoryGroup::create([
                'name' => $groupData['name'],
                'slug' => $groupData['slug'],
            ]);

            if(isset($groupData['categories'])){
                foreach ($groupData['categories'] as $categoryData) {
                    $category = $categoryGroup->categories()->create([
                        'name' => $categoryData['name'],
                        'slug' => $categoryData['slug'],
                    ]);

                    if (isset($categoryData['sub_categories'])){
                        foreach ($categoryData['sub_categories'] as $subCategoryData) {
                            $category->subCategories()->create([
                                'name' => $subCategoryData['name'],
                                'slug' => $subCategoryData['slug'],
                            ]);
                        }
                    }
                }
            }
        }
    }
}
