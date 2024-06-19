<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDistrict extends Model
{
    use HasFactory;

    public function OrderCities()
    {
        return $this->hasMany(OrderCity ::class);
    }
}
