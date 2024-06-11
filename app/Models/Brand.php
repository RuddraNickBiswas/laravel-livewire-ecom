<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Brand extends Model
{
    use HasFactory;

    protected $fillable =['name', 'slug', 'is_active', 'thumbnail'];


    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }


    public function brandUrl(){
        return $this->thumbnail
            ?  Storage::disk('brands')->url($this->thumbnail)
            : "https://logopond.com/logos/db69b8933f043810f3c4462c73585954.png";
    }
}
