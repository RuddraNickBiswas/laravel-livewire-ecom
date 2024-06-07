<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Dashboard')]
#[Layout('layouts.admin.main')]
class Page extends Component
{

    public $title;
    public $breadcrumbs;

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
    public function render()
    {
        return view('livewire.admin.dashboard.page');
    }
}
