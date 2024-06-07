<?php

namespace App\Livewire\Admin\Category\Index;

use App\Livewire\Forms\Admin\Category\CategoryForm;
use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Reactive;

class CategoryList extends Component
{

    public Category $category;

    public CategoryForm $form;



    public $showEditModal = false;

    public $showCreateModal = false;
    public $showDeleteModal = false;

    public function mount(Category $category)
    {

        $this->form->setCategory($this->category);
    }

    public function createModal()
    {
        $this->form->name = '';
    }

    public function editModal()
    {
        $this->form->resetForm();
        $this->form->setCategory($this->category);
    }

    public function save()
    {
        $this->category->update([
            'name' => $this->form->name,
            'slug' => Str::slug($this->form->name),
        ]);

        $this->showEditModal = false;
    }

    public function createSubCategory(){

        $this->category->subCategories()->create([
            'name' => $this->form->name,
            'slug' => Str::slug($this->form->name)
        ]);

        $this->showCreateModal = false;
    }

    public function delete($id)
    {
        $this->category->destroy($id);

        $this->dispatch('category-deleted');
        $this->showDeleteModal = false;
    }

    public function render()
    {
        return view('livewire.admin.category.index.category-list');
    }
}
