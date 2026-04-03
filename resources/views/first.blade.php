@extends('layouts.app')

@section('title', 'A4Florist | Toko Buket Bunga, Buket Uang, dan Parcel Terbaik di Wajo')
@section('description', 'Toko buket bunga, buket uang, dan parcel di Sengkang, Kabupaten Wajo. Layanan cepat, desain elegan, bisa dicustom dan harga terjangkau.')
@section('og_image', asset('images/Slide-1.svg'))

@section('content')
    <section class="bg-white">
        {{-- Hero Section --}}
        <div id="carousel"
            data-carousel='{ "loadingClasses": "opacity-0", "dotsItemClasses": "carousel-dot carousel-active:bg-[#AD8331]", "slidesQty": { "xs": 1, "lg": 1 }, "isDraggable": true, "isAutoPlay": true, "speed": 5000 }'
            class="relative w-full pt-20 px-4 sm:px-6 lg:px-8">
            <div class="carousel">
                <div
                    class="carousel-body h-full carousel-dragging:transition-none carousel-dragging:cursor-grabbing cursor-grab opacity-0">
                    <!-- Slide 1 -->
                    <div class="carousel-slide">
                        <div class="flex h-full justify-center">
                            <img loading="lazy" src="/images/Slide-1.svg" class="size-full object-cover" alt="slide-1" />
                        </div>
                    </div>
                    <!-- Slide 2 -->
                    <div class="carousel-slide">
                        <div class="flex h-full justify-center">
                            <img loading="lazy" src="/images/Slide-2.svg" class="size-full object-cover" alt="slide-2" />
                        </div>
                    </div>
                    <!-- Slide 3 -->
                    <div class="carousel-slide">
                        <div class="flex h-full justify-center">
                            <img loading="lazy" src="/images/Slide-3.svg" class="size-full object-cover" alt="slide-3" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-pagination absolute bottom-3 end-0 start-0 flex justify-center gap-3"></div>
        </div>

        {{-- Informasion --}}
        <div class="relative pt-3 px-4 sm:px-6 lg:px-8">
            <ul class="rounded-xl grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                <li class="bg-[#AD8331] block p-6 border border-default rounded-base shadow-xs">
                    <svg class="w-7 h-7 mb-3 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 21v-9m3-4H7.5a2.5 2.5 0 1 1 0-5c1.5 0 2.875 1.25 3.875 2.5M14 21v-9m-9 0h14v8a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-8ZM4 8h16a1 1 0 0 1 1 1v3H3V9a1 1 0 0 1 1-1Zm12.155-5c-3 0-5.5 5-5.5 5h5.5a2.5 2.5 0 0 0 0-5Z" />
                    </svg>
                    <a href="#">
                        <h5 class="mb-2 text-2xl max-sm:text-lg font-semibold tracking-tight text-white">Kualitas Terjamin
                            &
                            Custom</h5>
                    </a>
                    <p class="mb-3 max-sm:text-sm text-gray-100">Kami menggunakan material premium untuk buket dan pacel.
                        Setiap
                        pesanan
                        bisa disesuaikan dengan keinginanmu.</p>
                    <a href="#product"
                        class="inline-flex max-sm:text-base font-medium items-center text-amber-200 hover:underline">
                        Lihat Produk Kami
                        <svg class="w-4 h-4 ms-2 rtl:rotate-[270deg]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 14v4.833A1.166 1.166 0 0 1 16.833 20H5.167A1.167 1.167 0 0 1 4 18.833V7.167A1.166 1.166 0 0 1 5.167 6h4.618m4.447-2H20v5.768m-7.889 2.121 7.778-7.778" />
                        </svg>
                    </a>
                </li>

                <li class="bg-[#AD8331] block p-6 border border-default rounded-base shadow-xs">
                    <svg class="w-7 h-7 mb-3 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7.99999 10.8571 12 13.1428m-4.00001-2.2857L4 13.1428m3.99999-2.2857.00004-4.57139M12 13.1428v4.5715m0-4.5715-4.00001 2.2857M12 13.1428l4-2.2857m-4 2.2857V8.57143m0 4.57137 4 2.2858m-4 2.2857L7.99999 20M12 17.7143 16 20m-8.00001 0L4 17.7143v-4.5715M7.99999 20v-4.5715M4 13.1428l3.99999 2.2857M16 6.28571 12 4 8.00003 6.28571m7.99997 0v4.57139m0-4.57139-4 2.28572m4 2.28567 4 2.2858M8.00003 6.28571 12 8.57143m8 4.57147v4.5714L16 20m4-6.8571-4 2.2857M16 20v-4.5714" />
                    </svg>
                    <a href="#">
                        <h5 class="mb-2 text-2xl max-sm:text-lg font-semibold tracking-tight text-white">Pengiriman Cepat
                        </h5>
                    </a>
                    <p class="mb-3 max-sm:text-sm text-gray-100">Kami memahami momen spesialmu tidak bisa menunggu. Melayani
                        pengiriman
                        area Sengkang dan seluruh wilayah Wajo dengan aman dan tepat waktu.</p>
                    <button type="button" data-modal-target="daftar-kurir-modal" data-modal-toggle="daftar-kurir-modal"
                        class="inline-flex max-sm:text-base font-medium items-center text-amber-200 hover:underline">
                        Lihat Kurir Kami
                        <svg class="w-4 h-4 ms-2 rtl:rotate-[270deg]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 14v4.833A1.166 1.166 0 0 1 16.833 20H5.167A1.167 1.167 0 0 1 4 18.833V7.167A1.166 1.166 0 0 1 5.167 6h4.618m4.447-2H20v5.768m-7.889 2.121 7.778-7.778" />
                        </svg>
                    </button>

                    {{-- Modal Daftar Kurir --}}
                    <div id="daftar-kurir-modal" tabindex="-1" aria-hidden="true"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <!-- Modal content -->
                            <div
                                class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">
                                    <h3 class="text-lg font-medium text-heading">
                                        Daftar Partner Kurir Kami
                                    </h3>
                                    <button type="button"
                                        class="text-body dark:text-gray-500 bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center"
                                        data-modal-hide="daftar-kurir-modal">
                                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="space-y-4 md:space-y-6 py-4 md:py-6 text-black">
                                    <h3>Pilihan Pengiriman A4Florist</h3>
                                    <ul>
                                        <li>
                                            <strong>Sopir Mobil (Searah):</strong>
                                            Pengiriman aman via armada mobil yang menuju ke arah lokasi tujuan. Ideal
                                            untuk menjaga keamanan produk kami.
                                        </li>
                                        <li>
                                            <strong>Kurir Kepercayaan Pelanggan:</strong>
                                            Kami menerima pengambilan pesanan melalui kurir, travel, atau sopir pribadi
                                            pilihan Anda. Silakan kirimkan detail kontak kurir ke Admin.
                                        </li>
                                        <li>
                                            <strong>Kurir Internal:</strong>
                                            Layanan antar cepat khusus untuk area dalam kota.
                                        </li>
                                    </ul>
                                    <p><em>*Seluruh pesanan dipacking aman sebelum diserahkan ke pihak kurir.</em></p>
                                </div>
                                <!-- Modal footer -->
                                <div class="flex items-center border-t border-default space-x-4 pt-4 md:pt-5">
                                    <button data-modal-hide="daftar-kurir-modal" type="button"
                                        class="text-white bg-[#AD8331] box-border border border-transparent hover:bg-amber-500 focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">Saya
                                        Mengerti!</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </li>

                <li class="bg-[#AD8331] block p-6 border border-default rounded-base shadow-xs">
                    <svg class="w-7 h-7 mb-3 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                    </svg>
                    <a href="#">
                        <h5 class="mb-2 text-2xl max-sm:text-lg font-semibold tracking-tight text-white">Alur Pesan Sangat
                            Mudah</h5>
                    </a>
                    <p class="mb-3 max-sm:text-sm text-gray-100">Pesan kado spesial tidak perlu ribet. Cukup pilih produk,
                        klik, dan admin
                        kami akan memandu prosesnya langsung via WhatsApp.</p>
                    <button type="button" data-modal-target="metode-pemesanan-modal"
                        data-modal-toggle="metode-pemesanan-modal"
                        class="inline-flex max-sm:text-base font-medium items-center text-amber-200 hover:underline">
                        Lihat Cara Pemesanan
                        <svg class="w-4 h-4 ms-2 rtl:rotate-[270deg]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 14v4.833A1.166 1.166 0 0 1 16.833 20H5.167A1.167 1.167 0 0 1 4 18.833V7.167A1.166 1.166 0 0 1 5.167 6h4.618m4.447-2H20v5.768m-7.889 2.121 7.778-7.778" />
                        </svg>
                    </button>

                    {{-- Modal Cara Pesan --}}
                    <div id="metode-pemesanan-modal" tabindex="-1" aria-hidden="true"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <!-- Modal content -->
                            <div
                                class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">
                                    <h3 class="text-lg font-medium text-heading">
                                        Alur Pemesanan (Step-by-Step)
                                    </h3>
                                    <button type="button"
                                        class="text-body dark:text-gray-500 bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center"
                                        data-modal-hide="metode-pemesanan-modal">
                                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="space-y-4 md:space-y-6 py-4 md:py-6 text-black">
                                    <ol type="1" start="1">
                                        <li>
                                            <strong>Pilih Produk Favorit:</strong>
                                            Telusuri koleksi kami di bagian List Product. Temukan yang paling cocok untuk
                                            momenmu.
                                        </li>
                                        <li>
                                            <strong>Klik Cek Produk:</strong>
                                            Tekan tombol "Check" atau "Pesan Sekarang" pada produk pilihanmu. Kamu akan
                                            langsung diarahkan ke chat WhatsApp kami.
                                        </li>
                                        <li>
                                            <strong>Konsultasi & Isi Form:</strong>
                                            Admin A4Florist akan mengirimkan format pemesanan (Nama, Alamat, Ucapan, dll).
                                            Cukup isi form tersebut dan kirim kembali.
                                        </li>
                                        <li>
                                            <strong>Pembayaran Mudah:</strong>
                                            Lakukan pembayaran melalui transfer bank atau metode lain yang tersedia sesuai
                                            instruksi admin.
                                        </li>
                                        <li>
                                            <strong>Konfirmasi & Invoice:</strong>
                                            Setelah pembayaran dikonfirmasi, admin akan mengirimkan Invoice resmi sebagai
                                            tanda pesananmu sedang diproses. Duduk manis, dan pesananmu siap meluncur!
                                        </li>
                                    </ol>
                                </div>
                                <!-- Modal footer -->
                                <div class="flex items-center border-t border-default space-x-4 pt-4 md:pt-5">
                                    <button data-modal-hide="metode-pemesanan-modal" type="button"
                                        class="text-white bg-[#AD8331] box-border border border-transparent hover:bg-amber-500 focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">Saya
                                        Mengerti!</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        {{-- Product --}}
        <section id="product" class="product pb-20">
            <div class="mx-auto px-4 py-0.5 sm:px-6 lg:px-8 pt-6">
                <h3 class="text-xl font-semibold text-gray-900 sm:text-3xl">Product Collection</h3>
            </div>
            <div class="mx-auto px-4 py-0.5 sm:px-6 lg:px-8">
                <ul class="mt-3 grid gap-2 content-stretch max-sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    @forelse($products as $product)
                        <x-product.card :product="$product" />
                    @empty
                        <p class="col-span-full text-center text-gray-800">
                            Produk belum tersedia.
                        </p>
                    @endforelse
                </ul>
            </div>
        </section>
    </section>


@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
@endpush