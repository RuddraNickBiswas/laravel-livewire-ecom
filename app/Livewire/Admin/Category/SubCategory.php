<?php

namespace App\Livewire\Admin\Category;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Sub Category')]
#[Layout('layouts.admin.main')]
class SubCategory extends Component
{

    public $title;
    public $breadcrumbs;

    public function mount()
    {
        $this->title = 'Dashboard';
        $this->breadcrumbs = [
            [
                'name' => 'Category Group',
                'route' => route('admin.categoryGroup'),
            ],
            [
                'name' => 'Category',
                'route' => route('admin.category'),
            ],
            [
                'name' => 'Category',
                'route' => route('admin.subCategory'),
            ],
        ];
    }
    public function render()
    {
        return view('livewire.admin.category.sub-category');
    }
}
