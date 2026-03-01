<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderFormRequestItem extends Model
{
    
    protected $fillable = [
        "order_form_request_id",
        "product_id",
        "quantity",
    ];

    public function orderFormRequest()
    {
        return $this->belongsTo(OrderFormRequest::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
