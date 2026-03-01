<?php

use App\Http\Controllers\OrderFormController;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/order-form/{token}', [OrderFormController::class, 'show']);
Route::post('/order-form/{token}', [OrderFormController::class, 'store']);

Route::get('/', function () {
    return redirect('/admin');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/home2', function () {
    return view('home2');
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

