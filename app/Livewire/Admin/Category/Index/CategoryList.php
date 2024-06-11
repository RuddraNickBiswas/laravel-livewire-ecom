<?php

namespace App\Livewire\Admin\Category\Index;

use App\Models\CategoryGroup;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class CategoryList extends Component
{
    public CategoryGroup $categoryGroup ;

    public $categories = [];

    public function mount(CategoryGroup $categoryGroup){

        $this->categoryGroup = $categoryGroup;
       $this->updateCategoryList();
    }


    #[On('category-created.{categoryGroup.id}')]
    public function updateCategoryList(){

        $this->categories = $this->categoryGroup->categories()->get();
    }

    public function render()
    {
        return view('livewire.admin.category.index.category-list');
    }
}
