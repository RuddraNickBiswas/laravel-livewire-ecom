<?php

namespace App\Livewire\Forms\Admin;

use App\Models\Test;
use Illuminate\Validation\Rule;
use Livewire\Form;

class TestForm extends Form
{
    public $showSuccessIndicator = false;

    public Test $test;
    public $title;
    public $phone;
    public $description = 'lorem lorm';


    public function rules()
    {
        return [
            'title' => [
                'required',
                // Rule::unique('tests')->ignore($this->test),
            ],
            'phone' => 'required',
            'description' => 'required',

        ];
    }
    public function save()
    {
        $this->validate();

        Test::create([
            'title' => $this->title,
            'phone' => $this->phone,
            'description' => $this->description,
        ]);
    }

    public function setTest(Test $test)
    {
        $this->test = $test;
        $this->title = $test->title;
        $this->phone = $test->phone;
        $this->description = $test->description;
    }



    public function update()
    {

        $this->validate();
        $this->test->update([
            'title' => $this->title,
            'phone' => $this->phone,
            'description' => $this->description,
        ]);

        $this->showSuccessIndicator = true;
    }
}
