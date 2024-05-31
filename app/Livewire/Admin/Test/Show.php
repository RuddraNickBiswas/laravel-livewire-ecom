<?php

namespace App\Livewire\Admin\Test;

use App\Livewire\Forms\Admin\TestForm;
use App\Models\Test;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin.main')]
class Show extends Component
{
    public TestForm $form;



    public function mount(Test $test)
    {
        $this->form->setTest($test);
    }



    public function save()
    {
        $this->form->update();
    }

    public function render()
    {

        return view('livewire.admin.test.show');
    }
}
