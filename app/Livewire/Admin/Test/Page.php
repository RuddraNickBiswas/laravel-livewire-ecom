<?php

namespace App\Livewire\Admin\Test;

use App\Livewire\Forms\Admin\TestForm;
use App\Models\Test;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Test')]
#[Layout('layouts.admin.main', ['activeRoute' => 'page'])]
class Page extends Component
{


    use WithFileUploads;
    public TestForm $form ;

    public $title;
    public $breadcrumbs;

    public $status = 0;

    public $text;
    public $tests;

    #[Validate(['photos.*' => 'image|max:1024'])]
    public $photos = [];


    public function mount()
    {
        $this->title = 'Test';
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

        $this->tests = Test::orderBy('created_at', 'desc')
        ->take(1)
        ->get();
    }
    #[On('echo:asd,Example')]
    public function exampleBroadcast($data){
        dd($data);
    }

    public function save(){


        // $this->form->save();
        dd($this->text);
        // dd('own save');
    }

    public function render()
    {

        return view('livewire.admin.test.page');
    }
}
