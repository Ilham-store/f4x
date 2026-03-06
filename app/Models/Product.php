<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        "category_id",
        "name",
        "slug",
        "description",
        "price",
        "stock",
        "images",
        "is_active",
    ];
    protected function casts(): array
    { 
        return [
            'images' => 'array',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // public function getFirstImageAttribute()
    // {
    //     return $this->images[0] ?? 'https://placeholder.pics/svg/500';
    // }

    public function getFirstImageAttribute()
    {
        if (!$this->images || count($this->images) === 0) {
            return 'no-image.png';
        }

        return $this->images[0];
    }

    public function getPriceShortAttribute()
    {
        $price = $this->price;

        if ($price >= 1000000) {
            return 'IDR ' . rtrim(rtrim(number_format($price / 1000000, 1), '0'), '.') . 'M';
        }

        if ($price >= 1000) {
            return 'IDR ' . round($price / 1000) . 'K';
        }

        return 'IDR ' . $price;
    }

    public function getImageUrlsAttribute()
    {
        return collect($this->images)->map(function ($image) {
            return route('product.image', basename($image));
        });
    }
}

