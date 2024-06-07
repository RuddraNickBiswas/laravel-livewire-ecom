<?php

namespace App\Livewire\Admin\Category\Index;

use App\Models\SubCategory;
use Livewire\Component;

class SubCategoryList extends Component
{
    public SubCategory $subCategory;
    public function render()
    {
        return view('livewire.admin.category.index.sub-category-list');
    }
}
