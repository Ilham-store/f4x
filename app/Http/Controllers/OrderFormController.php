<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OrderFormRequest;
use Illuminate\Http\Request;

class OrderFormController extends Controller
{
    public function show($token)
    {
        $form = OrderFormRequest::where('token', $token)->firstOrFail();

        if ($form->status !== 'pending') {
            abort(404);
        }

        $itemsTotal = 0;

        foreach ($form->items as $item) {
            if (!$item->product) continue;
            $itemsTotal += $item->product->price * $item->quantity;
        }

        return view('order-form.show', [
            'form' => $form,
            'itemsTotal' => $itemsTotal,
        ]);

        // return view('order-form.show', compact('form'));
    }

    public function store(Request $request, $token)
    {
        $form = OrderFormRequest::where('token', $token)->firstOrFail();

        $request->validate([
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'payment_method' => 'required',
            'pickup_method' => 'required',
        ]);

        $form->update([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_instagram' => $request->customer_instagram,
            'payment_method' => $request->payment_method,
            'pickup_method' => $request->pickup_method,
            'pickup_date' => $request->pickup_date,
            'pickup_time' => $request->pickup_time,
            'delivery_address' => $request->delivery_address,
            'greeting_card' => $request->greeting_card,
            'balloon_message' => $request->balloon_message,
            'note' => $request->note,
            'status' => 'submitted',
        ]);

        return view('order-form.success');
    }
}
