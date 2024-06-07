<?php

namespace App\Livewire\Admin\Category\Index;

use App\Livewire\Forms\Admin\Category\CategoryForm;
use App\Models\CategoryGroup;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Reactive;

class CategoryGroupList extends Component
{

    public CategoryForm $form;
    public CategoryGroup $categoryGroup;



    public $showEditModal = false;

    public $showCreateModal = false;
    public $showDeleteModal = false;

    public function mount(CategoryGroup $categoryGroup)
    {

        $this->form->setCategoryGroup($this->categoryGroup);
    }

    public function createModal()
    {
        $this->form->name = '';
    }

    public function editModal()
    {
        $this->form->resetForm();
        $this->form->setCategoryGroup($this->categoryGroup);
    }

    public function save()
    {
        $this->categoryGroup->update([
            'name' => $this->form->name,
            'slug' => Str::slug($this->form->name),
        ]);

        $this->showEditModal = false;
    }

    public function createCategory(){

        $this->categoryGroup->categories()->create([
            'name' => $this->form->name,
            'slug' => Str::slug($this->form->name)
        ]);

        $this->showCreateModal = false;
    }

    public function delete($id)
    {
        $this->categoryGroup->destroy($id);

        $this->dispatch('category-group-deleted');
        $this->showDeleteModal = false;
    }
    public function render()
    {
        return view('livewire.admin.category.index.category-group-list');
    }
}
