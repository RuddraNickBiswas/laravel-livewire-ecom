<?php

namespace App\Livewire\Admin\Dashboard;

use App\Livewire\Form\Quill;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Dashboard')]
#[Layout('layouts.admin.main')]
class Page extends Component
{

    public $title;
    public $breadcrumbs;

    public $text = "<h1>hi broter</h1>";

    public function mount()
    {
        $this->title = 'Dashboard';


        $this->breadcrumbs = [
            [
                'name' => 'Test',
                'route' => route('admin.test'),
            ],
            [
                'name' => 'Dashboard',
                'route' => route('admin.dashboard'),
            ],
        ];
    }



    public function save (){
        dd($this->text);
    }

    public function render()
    {
        return view('livewire.admin.dashboard.page');
    }
}
