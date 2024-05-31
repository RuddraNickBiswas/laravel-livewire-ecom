<?php

namespace App\Livewire\Admin\Test;

use App\Livewire\Forms\Admin\TestForm;
use App\Models\Test;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

#[Layout('layouts.admin.main')]
class Page extends Component
{


    public TestForm $form ;

    // #[Reactive()]
    public $tests;





    public function mount()
    {
        $this->tests = Test::orderBy('created_at', 'desc')
        ->take(1)
        ->get();
    }
    #[On('echo:tests, example')]
    public function exampleBroadcast(){
        dd('bcsd');
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
