<?php

namespace App\Livewire\Admin\Category\Index;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Category')]
#[Layout('layouts.admin.main')]
class Page extends Component
{

    public $title;
    public $breadcrumbs;


    #[Validate('required')]
    public $name = 'hassss';

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
    }

    public function save(){
        $this->validate();
        sleep(5);
        dd($this->name);
    }
    public function render()
    {
        return view('livewire.admin.category.index.page');
    }
}
