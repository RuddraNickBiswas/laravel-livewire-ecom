<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderCity extends Model
{
    use HasFactory;

    protected $guarded =[];
    public function OrderDistrict() :BelongsTo
    {
        return $this->belongsTo(OrderDistrict::class);
    }
}
