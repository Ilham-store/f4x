<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Form Pemesanan</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-green-100 text-green-800 border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    <div class="min-h-screen flex items-center justify-center p-6">
        <div class="w-full max-w-4xl bg-white shadow-xl rounded-2xl p-8">

            {{-- HEADER --}}
            <div class="mb-8 text-center">
                <h1 class="text-2xl font-bold text-gray-800">
                    Form Pemesanan
                </h1>
                <p class="text-gray-500 text-sm">
                    Silakan isi data berikut untuk melanjutkan pesanan Anda
                </p>
            </div>

            {{-- RINGKASAN PRODUK --}}
            <div class="mb-8 border rounded-xl p-6 bg-gray-50">
                <h2 class="font-semibold text-lg mb-4">Ringkasan Produk</h2>

                <div class="space-y-3">
                    @php $total = 0; @endphp

                    @foreach($form->items as $item)
                        @php
                            $subtotal = $item->product->price * $item->quantity;
                            $total += $subtotal;
                        @endphp

                        <div class="flex justify-between">
                            <div>
                                <p class="font-medium">
                                    {{ $item->product->name }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    {{ $item->quantity }} x Rp {{ number_format($item->product->price) }}
                                </p>
                            </div>
                            <p class="font-semibold">
                                Rp {{ number_format($subtotal) }}
                            </p>
                        </div>
                    @endforeach
                </div>

                <div class="border-t mt-4 pt-4 flex justify-between font-bold text-lg">
                    <span>Total</span>
                    <span>Rp {{ number_format($total) }}</span>
                </div>
            </div>

            {{-- FORM --}}
            <form method="POST" action="{{ url('/order-form/' . $form->token) }}">
                @csrf

                <div class="grid grid-cols-2 gap-6">

                    <div>
                        <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                        <input type="text" name="customer_name"
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-400 focus:outline-none"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">No. HP</label>
                        <input type="text" name="customer_phone"
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-400 focus:outline-none"
                            required>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium mb-1">Instagram (Opsional)</label>
                        <input type="text" name="customer_instagram"
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-400 focus:outline-none"
                            placeholder="@username">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium mb-1">Alamat Pengiriman</label>
                        <textarea name="delivery_address"
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-400 focus:outline-none"
                            rows="3" required></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Tanggal Pengambilan</label>
                        <input type="date" name="pickup_date"
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-400 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Jam Pengambilan</label>
                        <input type="time" name="pickup_time"
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-400 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Metode Pembayaran</label>
                        <select name="payment_method"
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-400" required>
                            <option value="">Pilih Metode</option>
                            <option value="cash">Cash</option>
                            <option value="transfer">Transfer</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Metode Pengambilan</label>
                        <select name="pickup_method"
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-400" required>
                            <option value="">Pilih Metode</option>
                            <option value="courier">Kurir</option>
                            <option value="self_pickup">Ambil Sendiri</option>
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium mb-1">Isi Greeting Card</label>
                        <textarea name="greeting_card"
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-400 focus:outline-none"
                            rows="2"></textarea>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium mb-1">Ucapan di Balon</label>
                        <textarea name="balloon_message"
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-400 focus:outline-none"
                            rows="2"></textarea>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium mb-1">Catatan Tambahan</label>
                        <textarea name="note"
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-400 focus:outline-none"
                            rows="2"></textarea>
                    </div>

                </div>

                <div class="mt-8">
                    <button type="submit"
                        class="w-full bg-pink-500 hover:bg-pink-600 text-white font-semibold py-3 rounded-xl transition">
                        Kirim Pesanan
                    </button>
                </div>
            </form>

        </div>
    </div>

</body>

</html>