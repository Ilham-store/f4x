<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/images/a4florist_logo.svg" type="image/svg+xml">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <title>Form Pemesanan</title>
</head>

<body class="bg-gray-100">

    {{-- Forms New --}}
    <div class="pt-10 pb-40 bg-white">
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-100 text-green-800 border border-green-300">
                {{ session('success') }}
            </div>
        @endif

        <div class="px-4 mx-auto max-w-screen-md grid auto-rows-max place-items-center">
            <img class="h-35 max-md:h-20 mb-5 bg-amber-100 p-5 max-md:p-3 rounded-full" src="/images/a4florist_logo.svg"
                alt="Logo A4Florist">
            <h2 class="mb-3 text-4xl tracking-tight font-extrabold text-center text-gray-900">Form Pemesanan
            </h2>
            <p class="mb-8 lg:mb-16 font-light text-center text-gray-600 sm:text-xl">Silakan isi data
                di bawah ini untuk melanjutkan pesanan Anda.
            </p>
        </div>
        <div class="px-4 mx-auto max-w-screen-md">
            {{-- Rincian Pemesanan --}}
            <div class="bg-gray-100 block w-full p-6 border-2 border-[#ad8331] rounded-base shadow-x">
                <div>
                    <h2 class="pt-3 pb-6 text-xl font-bold leading-none text-gray-900 md:text-2x">
                        Ringkasan Pesanan</h2>
                </div>

                <div>
                    @php $total = 0; @endphp

                    @foreach($form->items as $item)
                        @php
                            $subtotal = $item->product->price * $item->quantity;
                            $total += $subtotal;
                        @endphp

                        <div class="flex justify-between p-3 bg-amber-100 rounded-lg">
                            <div>
                                <p class="font-bold text-black">
                                    {{ $item->product->name }}
                                </p>
                                <p class="text-sm font-normal text-[#AD8331]">
                                    {{ $item->quantity }} x Rp {{ number_format($item->product->price) }}
                                </p>
                            </div>
                            <p class="text-md font-extrabold text-gray-900">
                                Rp {{ number_format($subtotal) }}
                            </p>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 border-t pt-4 space-y-2 text-sm border-gray">
                    <div class="flex justify-between">
                        <span class="text-gray-700">Subtotal Produk</span>
                        <span class="text-black font-semibold">Rp {{ number_format($itemsTotal) }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-700">Biaya Tambahan</span>
                        <span class="text-black font-semibold">Rp {{ number_format($form->additional_cost) }}</span>
                    </div>

                    <div class=" flex justify-between">
                        <span class="text-red-600">Discount</span>
                        <span class="text-red-600 font-semibold">- Rp {{ number_format($form->discount) }}</span>
                    </div>

                    <div class="flex justify-between font-bold text-lg text-black border-t pt-2 border-gray">
                        <span>Total</span>
                        <span class="font-extrabold">
                            Rp {{ number_format(
    ($itemsTotal + $form->additional_cost) - $form->discount
) }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Forms Pemesanan --}}
            <div class="bg-gray-100 block w-full mt-4 p-6 border-2 border-[#ad8331] rounded-base shadow-x">
                <div>
                    <h2 class="pt-3 pb-6 text-xl font-bold leading-none text-gray-900 md:text-2x">
                        Data Informasi</h2>
                </div>
                <form method="POST" action="{{ url('/order-form/' . $form->token) }}" class="space-y-8">
                    @csrf

                    <div class="grid grid-cols-2 gap-6">
                        <div class="max-md:col-span-2">
                            <label for="nama_lengkap" class="block mb-2.5 text-sm font-medium text-heading">Nama
                                Lengkap<span class="text-red-500">*</span></label>
                            <input type="text" id="nama_lengkap"
                                class="bg-neutral-secondary-medium border border-[#AD8331] text-heading text-sm rounded-base focus:ring-[#AD8331] focus:border-[#AD8331] block w-full px-3 py-2.5 shadow-xs placeholder:text-gray-500"
                                placeholder="" required name="customer_name" />
                        </div>
                        <div class="max-md:col-span-2">
                            <label for="nomor_whatsapp" class="block mb-2.5 text-sm font-medium text-heading">Nomor
                                WhatsApp<span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-[#AD8331]" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M18.427 14.768 17.2 13.542a1.733 1.733 0 0 0-2.45 0l-.613.613a1.732 1.732 0 0 1-2.45 0l-1.838-1.84a1.735 1.735 0 0 1 0-2.452l.612-.613a1.735 1.735 0 0 0 0-2.452L9.237 5.572a1.6 1.6 0 0 0-2.45 0c-3.223 3.2-1.702 6.896 1.519 10.117 3.22 3.221 6.914 4.745 10.12 1.535a1.601 1.601 0 0 0 0-2.456Z" />
                                    </svg>
                                </div>
                                <input type="text" id="nomor_whatsapp" aria-describedby="helper-text-explanation"
                                    class="block w-full ps-9 pe-3 py-2.5 bg-neutral-secondary-medium border border-[#AD8331] text-heading text-sm rounded-base focus:ring-[#AD8331] focus:border-[#AD8331] shadow-xs placeholder:text-body dark:placeholder:text-gray-500"
                                    pattern="(08|628)[0-9]{8,11}" placeholder="081234567890" required
                                    name="customer_phone" />
                            </div>
                            <p id="helper-text-explanation" class="mt-2.5 text-sm text-gray-500">
                                Contoh Format :
                                081234567890</p>
                        </div>

                        <div class="col-span-2">
                            <label for="username_instagram"
                                class="block mb-2.5 text-sm font-medium text-heading">Username Instagram</label>
                            <div class="flex shadow-xs rounded-base">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-body bg-[#AD8331] border rounded-e-0 border-[#AD8331] border-e-0 rounded-s-base">

                                    <svg class="w-4 h-4 text-body bi bi-at" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="currentColor" class="bi bi-at" viewBox="0 0 16 16">
                                        <path
                                            d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914" />
                                    </svg>
                                </span>
                                <input type="text" name="customer_instagram" id="username_instagram"
                                    class="rounded-none rounded-e-base block w-full px-3 py-2.5 bg-neutral-secondary-medium border border-[#AD8331] text-heading text-sm focus:ring-[#AD8331] focus:border-[#AD8331] placeholder:text-gray-500"
                                    placeholder="username_instagram" />
                            </div>
                        </div>

                        <div class="">
                            <label for="tanggal_pengambilan"
                                class="block mb-2.5 text-sm font-medium text-heading">Tanggal Pengambilan<span
                                    class="text-red-500">*</span></label>
                            <div class="relative max-w-sm">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-[#AD8331]" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z" />
                                    </svg>
                                </div>
                                <input id="tanggal_pengambilan" type="date" name="pickup_date"
                                    class="block w-full ps-9 pe-3 bg-neutral-secondary-medium border border-[#AD8331] text-heading text-sm rounded-base focus:ring-[#AD8331] focus:border-[#AD8331] px-3 py-2.5 shadow-xs placeholder:text-gray-500"
                                    placeholder="Select date" required />
                            </div>
                        </div>

                        <div>
                            <label for="jam_pengambilan" class="block mb-2 text-sm font-medium text-heading">Jam
                                Pengambilan<span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-[#AD8331]" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </div>
                                <input name="pickup_time" type="time" id="jam_pengambilan"
                                    class="block w-full p-2.5 bg-neutral-secondary-medium border border-[#AD8331] text-heading text-sm rounded-base focus:ring-[#AD8331] focus:border-[#AD8331] shadow-xs placeholder:text-gray-500"
                                    required />
                            </div>
                        </div>

                        <div>
                            <label for="metode_pengambilan" class="block mb-2.5 text-sm font-medium text-heading">Metode
                                Pengambilan<span class="text-red-500">*</span></label>
                            <select name="pickup_method" id="metode_pengambilan"
                                class="block w-full px-3 py-2.5 bg-neutral-secondary-medium border border-[#AD8331] text-heading text-sm rounded-base focus:ring-[#AD8331] focus:border-[#AD8331] shadow-xs placeholder:text-gray-500"
                                placeholder="Pilih Pengambilan" required>
                                <option value="">Pilih Metode</option>
                                <option value="courier">Kurir</option>
                                <option value="self_pickup">Ambil Sendiri</option>
                            </select>
                        </div>

                        <div>
                            <label for="metode_pembayaran" class="block mb-2.5 text-sm font-medium text-heading">Metode
                                Pembayaran<span class="text-red-500">*</span></label>
                            <select name="payment_method" id="metode_pembayaran"
                                class="block w-full px-3 py-2.5 bg-neutral-secondary-medium border border-[#AD8331] text-heading text-sm rounded-base focus:ring-[#AD8331] focus:border-[#AD8331] shadow-xs placeholder:text-gray-500"
                                placeholder="Pilih Pengambilan" required>
                                <option value="">Pilih Metode</option>
                                <option value="cash">Cash</option>
                                <option value="transfer">Transfer</option>
                            </select>
                        </div>

                        <div class="col-span-2">
                            <label for="alamat_pengiriman" class="block mb-2.5 text-sm font-medium text-heading">Alamat
                                Pengiriman<span class="text-red-500">*</span></label>
                            <textarea name="delivery_address" id="alamat_pengiriman" rows="5"
                                class="bg-neutral-secondary-medium border border-[#AD8331] text-heading text-sm rounded-base focus:ring-[#AD8331] focus:border-[#AD8331] block w-full p-3.5 shadow-xs placeholder:text-gray-500"
                                placeholder="Tuliskan alamat lengkap kamu di sini..." required></textarea>
                            <p id="helper-text-explanation" class="mt-2.5 text-sm text-gray-500">
                                Jika Metode Pengambilannya "Ambil Sendiri" Silahkan diisikan Ambil Di Toko!</p>
                        </div>

                        <div class="col-span-2">
                            <label for="isi_greating_card" class="block mb-2.5 text-sm font-medium text-heading">Isi
                                Kartu Ucapan</label>
                            <textarea name="greeting_card" id="isi_greating_card" rows="5"
                                class="bg-neutral-secondary-medium border border-[#AD8331] text-heading text-sm rounded-base focus:ring-[#AD8331] focus:border-[#AD8331] block w-full p-3.5 shadow-xs placeholder:text-gray-500"
                                placeholder="Tuliskan isi kartu ucapan di sini..."></textarea>
                        </div>

                        <div class="col-span-2">
                            <label for="ucapan_di_balon" class="block mb-2.5 text-sm font-medium text-heading">Ucapan di
                                Balon (*Jika Ada)</label>
                            <textarea name="balloon_message" id="ucapan_di_balon" rows="5"
                                class="bg-neutral-secondary-medium border border-[#AD8331] text-heading text-sm rounded-base focus:ring-[#AD8331] focus:border-[#AD8331] block w-full p-3.5 shadow-xs placeholder:text-gray-500"
                                placeholder="Tuliskan isi ucapan balonmu di sini..."></textarea>
                            <p id="helper-text-explanation" class="mt-2.5 text-sm text-gray-500">
                                Ini diisi jika product yang dipesan memiliki balon.</p>
                        </div>

                        <div class="col-span-2">
                            <label for="catatan_tambahan" class="block mb-2.5 text-sm font-medium text-heading">Catatan
                                Tambahan (*Jika Ada)</label>
                            <textarea name="note" id="catatan_tambahan" rows="5"
                                class="bg-neutral-secondary-medium border border-[#AD8331] text-heading text-sm rounded-base focus:ring-[#AD8331] focus:border-[#AD8331] block w-full p-3.5 shadow-xs placeholder:text-gray-500"
                                placeholder="Tuliskan catatan tambahanmu di sini..."></textarea>
                        </div>
                    </div>
                    <div class="mt-8">
                        <button type="submit"
                            class="w-full bg-[#AD8331] hover:bg-amber-500 text-white font-semibold py-3 rounded-xl transition">
                            Kirim Pesanan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
</body>

</html>