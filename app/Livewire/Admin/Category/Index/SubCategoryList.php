<?php

namespace App\Livewire\Admin\Category\Index;

use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Component;

class SubCategoryList extends Component
{

    public Category $category;
    public $subCategories = [];

    public function mount(Category $category){

       $this->updateSubCategoryList();
    }


    #[On('sub-category-created.{category.id}')]
    #[On('sub-category-deleted.{category.id}')]
    public function updateSubCategoryList(){
        $this->subCategories = $this->category->subCategories()->get();
    }

    public function render()
    {
        return view('livewire.admin.category.index.sub-category-list');
    }
}
