<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCity extends Model
{
    use HasFactory;

    public function OrderDistrict()
    {
        return $this->belongsTo(OrderDistrict::class);
    }
}
