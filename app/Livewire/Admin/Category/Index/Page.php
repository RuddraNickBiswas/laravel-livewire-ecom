<?php

namespace App\Livewire\Admin\Category\Index;

use App\Livewire\Forms\Admin\Category\CategoryForm;
use App\Models\CategoryGroup;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

#[Title('Category')]
#[Layout('layouts.admin.main')]
class Page extends Component
{
    public CategoryForm $form;
    public $title;
    public $breadcrumbs;

    public $showModal = false;





    public $search = '';
    // #[Reactive]
    public $categoryGroups;


    #[Validate('required')]


    public function mount()
    {
        $this->title = 'Category';
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


        $this->categoryGroups = CategoryGroup::all();


    }


    public function updatedSearch()
    {
        $this->search();
    }

    public function search()
    {

        $this->categoryGroups = CategoryGroup::where('name', 'like', '%'.$this->search.'%')
            ->orWhereHas('categories', function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%')
                      ->orWhereHas('subCategories', function ($subQuery) {
                            $subQuery->where('name', 'like', '%'.$this->search.'%');
                        });
            })
            ->get();
    }


    #[On('category-group-deleted')]
    public function updateCategoryGroup(){
               $this->categoryGroups = CategoryGroup::all();
    }

    public function save(){
        $this->form->validate();
        CategoryGroup::create([
            'name' => $this->form->name,
            'slug' => Str::slug($this->form->name)
        ]);
        $this->updateCategoryGroup();
        $this->showModal = false;
    }
    public function render()
    {
        $categoryGroups = $this->search ? $this->categoryGroups : CategoryGroup::all();

        return view('livewire.admin.category.index.page', [
            'categoryGroups' => $categoryGroups,
        ]);
    }
}
