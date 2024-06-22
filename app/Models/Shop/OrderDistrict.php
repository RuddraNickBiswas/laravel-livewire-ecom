<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderDistrict extends Model
{
    use HasFactory;


    protected $guarded =[];


    public function orderCities() :HasMany
    {
        return $this->hasMany(OrderCity ::class);
    }
}
