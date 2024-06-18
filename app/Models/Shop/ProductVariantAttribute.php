<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantAttribute extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
