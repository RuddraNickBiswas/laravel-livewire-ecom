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
                'name' => 'Development',
                'children' => [
                    [
                        'name' => 'Web Development',
                        'children' => [
                            ['name' => 'Frontend Development'],
                            ['name' => 'Backend Development'],
                            ['name' => 'Full Stack Development'],
                            ['name' => 'Web Design'],
                            ['name' => 'Web Performance Optimization'],
                            ['name' => 'E-Commerce Development'],
                        ],
                    ],
                    [
                        'name' => 'Mobile Development',
                        'children' => [
                            ['name' => 'iOS Development'],
                            ['name' => 'Android Development'],
                            ['name' => 'Cross-platform Development (Flutter/React Native)'],
                            ['name' => 'Mobile App Design'],
                        ],
                    ],
                    [
                        'name' => 'Game Development',
                        'children' => [
                            ['name' => 'Unity Development'],
                            ['name' => 'Unreal Engine Development'],
                            ['name' => '2D Game Development'],
                            ['name' => '3D Game Development'],
                        ],
                    ],
                    [
                        'name' => 'Data Science & AI',
                        'children' => [
                            ['name' => 'Machine Learning'],
                            ['name' => 'Deep Learning'],
                            ['name' => 'Data Analysis & Visualization'],
                            ['name' => 'Natural Language Processing'],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Business',
                'children' => [
                    [
                        'name' => 'Entrepreneurship',
                        'children' => [
                            ['name' => 'Startup'],
                            ['name' => 'Business Ideas'],
                            ['name' => 'Business Model Canvas'],
                            ['name' => 'Pitching & Presentation Skills'],
                        ],
                    ],
                    [
                        'name' => 'Finance',
                        'children' => [
                            ['name' => 'Investing'],
                            ['name' => 'Personal Finance'],
                            ['name' => 'Financial Modeling'],
                            ['name' => 'Cryptocurrency & Blockchain'],
                        ],
                    ],
                    [
                        'name' => 'Marketing',
                        'children' => [
                            ['name' => 'Digital Marketing'],
                            ['name' => 'Social Media Marketing'],
                            ['name' => 'Content Marketing'],
                            ['name' => 'SEO & SEM'],
                        ],
                    ],
                ],
            ],
            // New categories
            [
                'name' => 'Design',
                'children' => [
                    [
                        'name' => 'Graphic Design',
                        'children' => [
                            ['name' => 'Logo Design'],
                            ['name' => 'Branding'],
                            ['name' => 'UI/UX Design'],
                            ['name' => 'Illustration'],
                        ],
                    ],
                    [
                        'name' => 'Motion Design',
                        'children' => [
                            ['name' => 'Animation'],
                            ['name' => 'Video Editing'],
                            ['name' => 'VFX & Compositing'],
                        ],
                    ],
                    [
                        'name' => 'Product Design',
                        'children' => [
                            ['name' => 'User Research'],
                            ['name' => 'Prototyping'],
                            ['name' => '3D Modeling'],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Lifestyle',
                'children' => [
                    [
                        'name' => 'Health & Fitness',
                        'children' => [
                            ['name' => 'Nutrition'],
                            ['name' => 'Exercise & Training'],
                            ['name' => 'Yoga & Meditation'],
                        ],
                    ],
                    [
                        'name' => 'Personal Development',
                        'children' => [
                            ['name' => 'Productivity'],
                            ['name' => 'Time Management'],
                            ['name' => 'Confidence & Self-Esteem'],
                        ],
                    ],
                    [
                        'name' => 'Creative Writing',
                        'children' => [
                            ['name' => 'Fiction Writing'],
                            ['name' => 'Non-Fiction Writing'],
                            ['name' => 'Poetry & Scriptwriting'],
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
