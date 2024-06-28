<?php

namespace App\Models\Shop;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderGroup extends Model
{
    use HasFactory;


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }


    public function deliveryDistrict(): BelongsTo
    {
        return $this->belongsTo(OrderDistrict::class, 'delivery_district_id');
    }

    public function deliveryCity(): BelongsTo
    {
        return $this->belongsTo(OrderCity::class, 'delivery_city_id');
    }
}
