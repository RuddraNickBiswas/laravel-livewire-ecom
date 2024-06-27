<?php

namespace App\Models\Shop;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shop extends Model
{
    use HasFactory;


    protected $guarded = [];

    public function members() :BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function products() :HasMany
    {
        return $this->hasMany(Product::class);
    }
}
