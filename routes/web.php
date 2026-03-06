<?php

use App\Http\Controllers\OrderFormController;
use App\Http\Controllers\ProductController;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;



// Order Forms
Route::get('/order-form/success', function () {
    return view('order-form.success');
});
Route::get('/order-form/{token}', [OrderFormController::class, 'show']);
Route::post('/order-form/{token}', [OrderFormController::class, 'store']);

// Route::get('/first', function () {
//     return view('first');
// });

Route::get('/', [ProductController::class, 'index'])
    ->name('first');


Route::get('/contact', function () {
    return view('contact');
});

// Ini kalau sewaktu-waktu invoicenya mau dimunculin ke User
// Route::get('/orders/{order}/print', function (Order $order) {
//     $order->load('items.product');

//     return view('invoices.order', [
//         'order' => $order,
//     ]);
// })->name('orders.print');


Route::get('/orders/{order}/print', function (Order $order) {

    if (Auth::guest()) {
        return redirect('/admin');
    }

    $order->load('items.product');

    return view('invoices.order', [
        'order' => $order,
    ]);

})->name('orders.print');


Route::get('/product-image/{filename}', function ($filename) {

    $path = storage_path('app/private/products/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
})->name('product.image');

Route::get('/product/{slug}', [ProductController::class, 'show'])
    ->name('productview');

