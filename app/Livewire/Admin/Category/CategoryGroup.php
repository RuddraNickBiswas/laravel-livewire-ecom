<?php

namespace App\Livewire\Admin\Category;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Category Group')]
#[Layout('layouts.admin.main')]
class CategoryGroup extends Component
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
        ];
    }
    public function render()
    {
        return view('livewire.admin.category.category-group');
    }
}
