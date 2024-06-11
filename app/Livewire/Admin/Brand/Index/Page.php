<?php

namespace App\Livewire\Admin\Brand\Index;

use App\Livewire\Forms\Admin\Brand\BrandForm;
use App\Models\Brand;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

#[Title('Brand')]
#[Layout('layouts.admin.main')]
class Page extends Component
{

    use WithFileUploads;
    public BrandForm $form;

    public $breadcrumbs;


    public function mount()
    {

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

    public function create()
    {
        $this->form->save();
    }


    public function render()
    {
        return view('livewire.admin.brand.index.page');
    }
}
