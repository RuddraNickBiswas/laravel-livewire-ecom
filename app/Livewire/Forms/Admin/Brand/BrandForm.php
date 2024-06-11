<?php

namespace App\Livewire\Forms\Admin\Brand;

use App\Models\Brand;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Str;

class BrandForm extends Form
{


    // #[Validate('required')] // 1MB Max
    public $name = '';

    public $is_active = false;

    #[Validate('image|max:1024')] // 1MB Max
    public $thumbnail;

    #[Validate(['photos.*' => 'image|max:1024'])]
    public $photos = [];


    public $showCreateModal = false;

    public function save()
    {
        $this->validate();
        dd($this->photos);

        $filename = $this->thumbnail->store('/', 'brands');

        Brand::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'is_active' => $this->is_active,
            'thumbnail' => $filename,
        ]);

        $this->resetForm();
        $this->showCreateModal = false;
    }


    public function resetForm()
    {
        $this->reset();
    }
}
