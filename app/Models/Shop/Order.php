<?php

namespace App\Models\Shop;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];



    protected function casts(): array
    {
        return [
            'status' => OrderStatus::class,
            'payment_status' => PaymentStatus::class,
        ];
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function deliveryDistrict() :BelongsTo
        {
            return $this->belongsTo(OrderDistrict::class, 'delivery_district_id');
        }

    public function deliveryCity() :BelongsTo
        {
            return $this->belongsTo(OrderCity::class, 'delivery_city_id');
        }

        public function shop()
        {
            return $this->belongsTo(Shop::class);
        }

        public function orderGroup()
        {
            return $this->belongsTo(OrderGroup::class);
        }


}
