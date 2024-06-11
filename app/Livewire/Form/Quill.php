<?php

namespace App\Livewire\Form;

use Livewire\Component;

class Quill extends Component
{
    const EVENT_VALUE_UPDATED = 'quill_value_updated';
    public $value;



    public $quillId;



    public function mount($value = ''){

        $this->value = $value;

        $this->quillId = 'quill-'.uniqid();

    }

    public function updatedValue($value) {

        $this->dispatch(self::EVENT_VALUE_UPDATED, $this->value);

    }



    public function render()
    {

        return view('livewire.form.quill');
    }
}
