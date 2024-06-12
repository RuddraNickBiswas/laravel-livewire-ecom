<?php

namespace App\Models;

use App\Enums\DeliveryStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'phone',
        'price',
        'color',
        'thumbnail',
        'is_active',
        'description',
    ];


    protected function casts(): array
    {
        return [
            'status' => DeliveryStatus::class,
        ];
    }


    public function thumbnailUrl(){
        return $this->thumbnail
            ?  Storage::disk('test')->url($this->thumbnail)
            : "https://logopond.com/logos/db69b8933f043810f3c4462c73585954.png";
    }
}
