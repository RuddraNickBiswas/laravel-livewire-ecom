<?php

namespace App\Livewire\Admin\Category\Index;

use App\Livewire\Forms\Admin\Category\CategoryForm;
use App\Models\Category;
use App\Models\SubCategory;
use Livewire\Component;
use Illuminate\Support\Str;

class SubCategoryListItem extends Component
{

    public CategoryForm $form;

    public Category $category;
    public SubCategory $subCategory;

    public $showEditModal = false;


    public $showDeleteModal = false;

    public function mount( Category $category , SubCategory $subCategory)
    {

        $this->form->setSubCategory($this->subCategory);
    }


    public function editModal()
    {
        $this->form->setSubCategory($this->subCategory);
    }

    public function save()
    {
        $this->subCategory->update([
            'name' => $this->form->name,
            'slug' => Str::slug($this->form->name),
        ]);

        $this->showEditModal = false;
    }

    public function delete($id)
    {
        $this->subCategory->destroy($id);

        $this->dispatch('sub-category-deleted.'.$this->category->id);
        $this->showDeleteModal = false;
    }

    public function render()
    {
        return view('livewire.admin.category.index.sub-category-list-item');
    }
}
