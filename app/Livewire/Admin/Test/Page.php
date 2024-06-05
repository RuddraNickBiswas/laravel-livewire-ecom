<?php

namespace App\Livewire\Admin\Test;

use App\Livewire\Forms\Admin\TestForm;
use App\Models\Test;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Test')]
#[Layout('layouts.admin.main', ['activeRoute' => 'page'])]
class Page extends Component
{


    public TestForm $form ;

    public $title;
    public $breadcrumbs;

    public $tests;



    public function mount()
    {
        $this->title = 'Test';
        $this->breadcrumbs = [
            [
                'name' => 'Test',
                'route' => 'admin.test',
            ],
            [
                'name' => 'Dashboard',
                'route' => 'admin.dashboard',
            ],
        ];

        $this->tests = Test::orderBy('created_at', 'desc')
        ->take(1)
        ->get();
    }
    #[On('echo:asd,Example')]
    public function exampleBroadcast($data){
        dd($data);
    }

    public function save(){

        $this->form->save();
        // dd('own save');
    }

    public function render()
    {

        return view('livewire.admin.test.page');
    }
}
