<?php

namespace App\Livewire\Fn\Home\Index;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Home')]
class Page extends Component
{
    public function render()
    {
        return view('livewire.fn.home.index.page');
    }
}
