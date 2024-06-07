<?php

namespace App\Livewire\Admin\Ui;

use Livewire\Attributes\On;
use Livewire\Component;

class Menu extends Component
{
    public $name = 'default';
    #[On('routeChanged')]
    public function routeChanged($name){
        // dd($name);
        $this->name = $name;
    }
    public function render()
    {
        return view('livewire.admin.ui.menu');
    }
}
