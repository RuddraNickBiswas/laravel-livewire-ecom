<?php

namespace App\Livewire\Forms\Admin\Category;

use App\Models\Category;
use App\Models\CategoryGroup;
use App\Models\SubCategory;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CategoryForm extends Form
{
    public CategoryGroup $categoryGroup;
    public Category $category;
    public SubCategory $subCategory;

    #[Validate('required')]
    public String $name;

    public function setCategoryGroup(CategoryGroup $categoryGroup) :Void
    {
        $this->name = $categoryGroup->name;
    }

    public function setCategory(Category $category) :Void
    {

        $this->name = $category->name;
    }

    public function setSubCategory(SubCategory $subCategory) :Void
    {

        $this->name = $subCategory->name;
    }


    public function resetForm()
    {
        $this->reset([$this->name]);
        $this->resetValidation(); // This will reset the validation errors
    }

}
