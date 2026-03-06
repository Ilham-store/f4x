<?php

namespace App\View\Components\Product;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function render(): View|Closure|string
    {
        return view('components.product.card');
    }
}
