<?php

namespace App\Livewire\Admin\Auth;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Admin Login')]
#[Layout('layouts.admin.blank')]
class Login extends Component
{
    public function render()
    {
        return view('livewire.admin.auth.login');
    }
}
