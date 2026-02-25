<?php

namespace App\Models;

use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    protected $fillable = [
        "order_number",
        "user_id",
        "customer_name",
        "customer_phone",
        "customer_instagram",
        "delivery_address",
        "note",
        "total_amount",
        "extra_cost",
        "discount_type",
        "discount_value",
        "grand_total",
        "status",
        "payment_method",
        "pickup_method",
        "pickup_date",
        "pickup_time",
        "greeting_card",
        "balloon_message",
        "stock_adjusted",
        "order_date",
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    protected static function booted()
    {
        static::creating(function ($order) {
            if (Auth::check()) {
                $order->user_id = Auth::id();
            }
        });

        static::saved(function ($order) {

            // Reload items setelah benar-benar tersimpan
            $order->load('items.product');
    
            // Jangan proses kalau sudah pernah adjust
            if ($order->stock_adjusted) {
                return;
            }
    
            if ($order->status !== 'cancelled') {
    
                foreach ($order->items as $item) {
    
                    if ($item->product) {
                        $item->product->decrement('stock', $item->quantity);
                    }
                }
    
                $order->updateQuietly([
                    'stock_adjusted' => true
                ]);
            }
        });
    
        static::updated(function ($order) {
    
            if ($order->isDirty('status') &&
                $order->status === 'cancelled' &&
                $order->stock_adjusted) {
    
                $order->load('items.product');
    
                foreach ($order->items as $item) {
    
                    if ($item->product) {
                        $item->product->increment('stock', $item->quantity);
                    }
                }
    
                $order->updateQuietly([
                    'stock_adjusted' => false
                ]);
            }
        });
    }

}
