<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Dashboard')]
#[Layout('layouts.admin.main')] 
class Page extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard.page');
    }
}
