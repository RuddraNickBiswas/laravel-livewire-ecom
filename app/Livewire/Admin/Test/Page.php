<?php

namespace App\Livewire\Admin\Test;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin.main')] 
class Page extends Component
{

    public function hello (){
        dd('hello');
    }

    public function render()
    {
        return view('livewire.admin.test.page');
    }
}
