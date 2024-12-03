<?php

namespace Database\Seeders;

use App\Models\Shop\Category;
use App\Models\CategoryGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'children' => [
                    [
                        'name' => 'Mobile Phones',
                        'children' => [
                            ['name' => 'Smartphones'],
                            ['name' => 'Feature Phones'],
                            ['name' => 'Accessories'],
                        ],
                    ],
                    [
                        'name' => 'Laptops & Computers',
                        'children' => [
                            ['name' => 'Laptops'],
                            ['name' => 'Desktops'],
                            ['name' => 'PC Accessories'],
                        ],
                    ],
                    [
                        'name' => 'Cameras & Photography',
                        'children' => [
                            ['name' => 'Digital Cameras'],
                            ['name' => 'Camera Lenses'],
                            ['name' => 'Tripods & Stands'],
                        ],
                    ],
                    [
                        'name' => 'Audio & Headphones',
                        'children' => [
                            ['name' => 'Headphones'],
                            ['name' => 'Earphones'],
                            ['name' => 'Speakers'],
                            ['name' => 'Home Audio Systems'],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Fashion',
                'children' => [
                    [
                        'name' => 'Men',
                        'children' => [
                            ['name' => 'Clothing'],
                            ['name' => 'Footwear'],
                            ['name' => 'Accessories'],
                        ],
                    ],
                    [
                        'name' => 'Women',
                        'children' => [
                            ['name' => 'Clothing'],
                            ['name' => 'Footwear'],
                            ['name' => 'Accessories'],
                            ['name' => 'Jewelry'],
                        ],
                    ],
                    [
                        'name' => 'Kids & Baby',
                        'children' => [
                            ['name' => 'Clothing'],
                            ['name' => 'Footwear'],
                            ['name' => 'Toys & Games'],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Home & Living',
                'children' => [
                    [
                        'name' => 'Furniture',
                        'children' => [
                            ['name' => 'Living Room'],
                            ['name' => 'Bedroom'],
                            ['name' => 'Office Furniture'],
                        ],
                    ],
                    [
                        'name' => 'Home Decor',
                        'children' => [
                            ['name' => 'Wall Art'],
                            ['name' => 'Lighting'],
                            ['name' => 'Rugs & Carpets'],
                            ['name' => 'Curtains & Blinds'],
                        ],
                    ],
                    [
                        'name' => 'Kitchenware',
                        'children' => [
                            ['name' => 'Cookware'],
                            ['name' => 'Tableware'],
                            ['name' => 'Storage & Organization'],
                        ],
                    ],
                    [
                        'name' => 'Bedding & Linen',
                        'children' => [
                            ['name' => 'Bedding Sets'],
                            ['name' => 'Pillows & Cushions'],
                            ['name' => 'Mattresses'],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Health & Beauty',
                'children' => [
                    [
                        'name' => 'Personal Care',
                        'children' => [
                            ['name' => 'Skin Care'],
                            ['name' => 'Hair Care'],
                            ['name' => 'Oral Care'],
                        ],
                    ],
                    [
                        'name' => 'Makeup',
                        'children' => [
                            ['name' => 'Face Makeup'],
                            ['name' => 'Eye Makeup'],
                            ['name' => 'Lip Makeup'],
                        ],
                    ],
                    [
                        'name' => 'Fitness & Nutrition',
                        'children' => [
                            ['name' => 'Supplements'],
                            ['name' => 'Fitness Gear'],
                            ['name' => 'Sportswear'],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Sports & Outdoors',
                'children' => [
                    [
                        'name' => 'Camping & Hiking',
                        'children' => [
                            ['name' => 'Tents'],
                            ['name' => 'Backpacks'],
                            ['name' => 'Sleeping Bags'],
                        ],
                    ],
                    [
                        'name' => 'Cycling',
                        'children' => [
                            ['name' => 'Bikes'],
                            ['name' => 'Bike Accessories'],
                            ['name' => 'Cycling Apparel'],
                        ],
                    ],
                    [
                        'name' => 'Outdoor Sports',
                        'children' => [
                            ['name' => 'Fishing'],
                            ['name' => 'Running'],
                            ['name' => 'Golf'],
                            ['name' => 'Winter Sports'],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Books & Media',
                'children' => [
                    [
                        'name' => 'Books',
                        'children' => [
                            ['name' => 'Fiction'],
                            ['name' => 'Non-Fiction'],
                            ['name' => 'Children’s Books'],
                            ['name' => 'Educational Books'],
                        ],
                    ],
                    [
                        'name' => 'Music',
                        'children' => [
                            ['name' => 'Vinyl Records'],
                            ['name' => 'CDs & DVDs'],
                            ['name' => 'Musical Instruments'],
                        ],
                    ],
                    [
                        'name' => 'Movies & TV Shows',
                        'children' => [
                            ['name' => 'Blu-ray'],
                            ['name' => 'DVD'],
                            ['name' => 'Streaming Services'],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Groceries',
                'children' => [
                    [
                        'name' => 'Fresh Produce',
                        'children' => [
                            ['name' => 'Fruits'],
                            ['name' => 'Vegetables'],
                            ['name' => 'Herbs'],
                        ],
                    ],
                    [
                        'name' => 'Beverages',
                        'children' => [
                            ['name' => 'Soft Drinks'],
                            ['name' => 'Juices'],
                            ['name' => 'Alcoholic Beverages'],
                            ['name' => 'Tea & Coffee'],
                        ],
                    ],
                    [
                        'name' => 'Snacks & Sweets',
                        'children' => [
                            ['name' => 'Chocolates'],
                            ['name' => 'Chips & Crisps'],
                            ['name' => 'Cookies'],
                        ],
                    ],
                    [
                        'name' => 'Organic & Health Foods',
                        'children' => [
                            ['name' => 'Gluten-Free'],
                            ['name' => 'Vegan'],
                            ['name' => 'Superfoods'],
                        ],
                    ],
                ],
            ],
        ];


        foreach ($categories as $category) {
            $this->createCategory($category);
        }
    }

    protected function createCategory($category, $parentCategory = null)
    {
        $newCategory = Category::create([
            'name' => $category['name'],
            'slug' => \Str::slug($category['name']),
            'parent_id' => $parentCategory ? $parentCategory->id : null,
        ]);

        if (isset($category['children'])) {
            foreach ($category['children'] as $child) {
                $this->createCategory($child, $newCategory);
            }
        }
    }
}
