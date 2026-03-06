<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
        {
            $products = Product::query()
                ->with(['category'])
                ->where('is_active', true)
                ->whereHas('category', fn ($q) => $q->where('is_active', true))
                ->latest()
                ->get();

            return view('first', compact('products'));
        }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->with('category')
            ->firstOrFail();

        return view('productview', compact('product'));
    }

    public function image($filename)
    {
        $path = storage_path('app/private/products/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }
}
