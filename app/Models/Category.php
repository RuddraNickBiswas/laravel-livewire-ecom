<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name' , 'slug','parent_id','is_active',];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }


    public static function category()
    {
        return self::whereNull('parent_id');
    }


    public function subCategories(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')->with('subcategories');
    }
    public function scopeSelectable($query)
    {
        return $query->whereDoesntHave('children');
    }

    public function getDescendantsAndSelf()
    {
        $descendants = collect([$this->id]);

        foreach ($this->children as $child) {
            $descendants = $descendants->merge($child->getDescendantsAndSelf());
        }

        return $descendants;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product');
    }

}
