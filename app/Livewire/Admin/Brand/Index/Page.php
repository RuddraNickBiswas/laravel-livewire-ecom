<?php

namespace App\Livewire\Admin\Brand\Index;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Title('Brand')]
#[Layout('layouts.admin.main')]
class Page extends Component
{

    public $breadcrumbs;

    public $setActive = 'false';

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

    public function save (){
        dd('hi');
    }

    public function render()
    {
        return view('livewire.admin.brand.index.page');
    }
}
