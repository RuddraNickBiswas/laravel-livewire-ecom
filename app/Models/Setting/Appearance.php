<?php

namespace App\Models\Setting;

use App\Enums\Setting\Font;
use App\Enums\Setting\PrimaryColor;
use App\Enums\Setting\RecordsPerPage;
use App\Enums\Setting\TableSortDirection;
use App\Models\Shop\Shop;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appearance extends Model
{
    use HasFactory;



    protected $fillable = [
        'company_id',
        'primary_color',
        'bg_color',
        'font',
        'table_sort_direction',
        'records_per_page',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'primary_color' => PrimaryColor::class,
            'bg_color' => PrimaryColor::class,
            'font' => Font::class,
            'table_sort_direction' => TableSortDirection::class,
            'records_per_page' => RecordsPerPage::class,
        ];
    }


    public function shop() :BelongsTo
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }



}
