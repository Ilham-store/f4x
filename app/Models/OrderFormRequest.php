<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class OrderFormRequest extends Model
{
    protected $fillable = [
        "token",
        "product_id",
        "customer_name",
        "customer_phone",
        "customer_instagram",
        "delivery_address",
        "payment_method",
        "pickup_method",
        "note",
        "pickup_date",
        "pickup_time",
        "greeting_card",
        "balloon_message",
        "status",

    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    public function items()
    {
        return $this->hasMany(OrderFormRequestItem::class);
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            if (! $model->token) {
                $model->token = Str::uuid();
            }
        });
    }
}
