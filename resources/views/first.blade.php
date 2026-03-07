<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/images/a4florist_logo.svg" type="image/svg+xml">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <title>Home - A4Florist</title>
</head>

<body class="bg-white">
    {{-- header --}}
    <header class="fixed top-0 left-0 w-full z-50 bg-white/80 backdrop-blur-md border-b border-gray-200">
        <div class="mx-auto flex h-16 items-center gap-6 px-4 sm:px-6 lg:px-8">
            <a class="block text-amber-600" href="/">
                <span class="sr-only">Home</span>
                <img src="/images/a4florist_logo.svg" alt="A4florist_Logo" class="h-9">
            </a>

            <a href="/">
                <div class="hidden sm:block">
                    <h2 class="text-2xl font-semibold text-[#ad8331]">A4Florist</h2>
                </div>
            </a>

            <div class="flex flex-1 items-center justify-end md:justify-between">
                <nav aria-label="Global" class="hidden md:block">
                    <ul class="flex items-center gap-6 text-sm">
                        <li>
                            <a class="text-gray-500 transition hover:text-[#AD8331]" href="/">
                                Home </a>
                        </li>

                        <li>
                            <a class="text-gray-500 transition hover:text-gray-500/75" href="#product"> Product </a>
                        </li>

                        <li class="hidden">
                            <a class="text-gray-500 transition hover:text-gray-500/75" href="#"> Blog </a>
                        </li>

                        <li class="hidden">
                            <a class="text-gray-500 transition hover:text-gray-500/75" href="#"> About </a>
                        </li>
                    </ul>
                </nav>

                <div class="flex items-center gap-4">
                    <div class="sm:flex sm:gap-4">
                        <a class="block rounded-md bg-[#AD8331] px-5 py-2.5 text-sm font-medium text-white transition hover:bg-amber-700"
                            href="/contact">
                            Contact
                        </a>

                        <a class="hidden rounded-md bg-amber-100 px-5 py-2.5 text-sm font-medium text-[#AD8331] transition hover:text-amber-600/75 sm:block"
                            href="/admin">
                            Login
                        </a>
                    </div>

                    <div class="dropdown relative inline-flex">
                        <button id="nested-dropdown" type="button"
                            class="dropdown-toggle btn btn-primary block rounded-sm border-0 ring ring-amber-500 bg-gray-100 p-2.5 active:bg-amber-200 text-gray-600 transition hover:text-gray-600/75 md:hidden "
                            aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                            <span class="sr-only dropdown-open:rotate-180 size-4">Toggle menu</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                        <ul class="dropdown-menu dropdown-open:opacity-100 hidden min-w-60" role="menu"
                            aria-orientation="vertical" aria-labelledby="nested-dropdown">
                            <li><a class="dropdown-item" href="/">Home</a></li>
                            <li><a class="dropdown-item" href="#product">Product</a></li>
                            <li><a class="dropdown-item hidden" href="#">Blog</a></li>
                            <li><a class="dropdown-item hidden" href="#">About</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- Hero Section --}}
    <div id="indicators auto-play draggable"
        data-carousel='{ "loadingClasses": "opacity-0", "dotsItemClasses": "carousel-dot carousel-active:bg-[#AD8331]", "isAutoPlay": true, "speed": 3000, "slidesQty": { "xs": 1, "lg": 1 }, "isDraggable": true }'
        class="relative w-full pt-20 px-4 sm:px-6 lg:px-8">
        <div class="carousel h-h-max">
            <div class="carousel-body h-full opacity-0">
                <!-- Slide 1 -->
                <div class="carousel-slide">
                    <div class="flex h-full justify-center">
                        <img src="/images/Slide-1.svg" class="size-full object-cover" alt="game" />
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="carousel-slide">
                    <div class="flex h-full justify-center">
                        <img src="/images/Slide-2.svg" class="size-full object-cover" alt="game" />
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="carousel-slide">
                    <div class="flex h-full justify-center">
                        <img src="/images/Slide-3.svg" class="size-full object-cover" alt="game" />
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
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-white">Kualitas Terjamin & Custom</h5>
                </a>
                <p class="mb-3 text-gray-100">Kami menggunakan material premium untuk buket dan pacel. Setiap pesanan
                    bisa disesuaikan dengan keinginanmu.</p>
                <a href="#product" class="inline-flex font-medium items-center text-amber-200 hover:underline">
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
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-white">Pengiriman Cepat</h5>
                </a>
                <p class="mb-3 text-gray-100">Kami memahami momen spesialmu tidak bisa menunggu. Melayani pengiriman
                    area Sengkang dan seluruh wilayah Wajo dengan aman dan tepat waktu.</p>
                <button type="button" data-modal-target="daftar-kurir-modal" data-modal-toggle="daftar-kurir-modal"
                    class="inline-flex font-medium items-center text-amber-200 hover:underline">
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
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-white">Alur Pesan Sangat Mudah</h5>
                </a>
                <p class="mb-3 text-gray-100">Pesan kado spesial tidak perlu ribet. Cukup pilih produk, klik, dan admin
                    kami akan memandu prosesnya langsung via WhatsApp.</p>
                <button type="button" data-modal-target="metode-pemesanan-modal"
                    data-modal-toggle="metode-pemesanan-modal"
                    class="inline-flex font-medium items-center text-amber-200 hover:underline">
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
            <ul class="mt-3 grid gap-2 max-sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 items-stretch">
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

    {{-- Footer --}}
    <footer class="bg-[#AD8331]">
        <div class="mx-auto px-4 pt-16 pb-8 sm:px-6 lg:px-8 lg:pt-24">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-white sm:text-5xl">
                    Punya Ide Sendiri? Ayo Custom!
                </h2>

                <p class="mx-auto mt-4 max-w-xl max-md:max-w-sm text-white">
                    Kamu bisa sesuaikan warna kertas wrapping, jenis bunga, hingga jumlah uang sesuai keinginanmu.
                    Beritahu kami konsepmu, dan kami akan mewujudkannya.
                </p>

                {{-- Button Konsultasi Gratis --}}
                <div class="flex justify-center">
                    <Button data-modal-target="konsultasi-gratis-modal" data-modal-toggle="konsultasi-gratis-modal"
                        type="button"
                        class="flex mt-8 max-w-md justify-center gap-2 rounded-full border-2 border-white-600 px-12 py-3 text-sm font-medium text-white hover:text-amber-600 hover:bg-white">
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.213 9.787a3.391 3.391 0 0 0-4.795 0l-3.425 3.426a3.39 3.39 0 0 0 4.795 4.794l.321-.304m-.321-4.49a3.39 3.39 0 0 0 4.795 0l3.424-3.426a3.39 3.39 0 0 0-4.794-4.795l-1.028.961" />
                        </svg>
                        <span>Konsultasi Gratis</span>
                </div>
            </div>
            {{-- Modal Konsultasi Gratis --}}
            <div id="konsultasi-gratis-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div
                        class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">
                            <h3 class="text-lg font-medium text-heading">
                                Form Konsultasi Gratis
                            </h3>
                            <button type="button"
                                class="text-body dark:text-gray-500 bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center"
                                data-modal-hide="konsultasi-gratis-modal">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form id="waConsultationForm" class="pt-4 md:pt-6">
                            <div class="mb-4">
                                <label for="name" class="block mb-2.5 text-sm font-medium text-heading">Nama
                                    Pelanggan</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-[#AD8331]" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-width="2"
                                                d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="name"
                                        class="block w-full ps-9 pe-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-[#AD8331] focus:border-[#AD8331] shadow-xs placeholder:text-body dark:placeholder:text-gray-500"
                                        placeholder="Nama Kamu" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="phone" class="block mb-2.5 text-sm font-medium text-heading">Nomor
                                    WhatsApp</label>
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
                                    <input type="text" id="phone" aria-describedby="helper-text-explanation"
                                        class="block w-full ps-9 pe-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-[#AD8331] focus:border-[#AD8331] shadow-xs placeholder:text-body dark:placeholder:text-gray-500"
                                        pattern="(08|628)[0-9]{8,11}" placeholder="081234567890" required />
                                </div>
                                <p id="helper-text-explanation" class="mt-2.5 text-sm text-body dark:text-gray-500">
                                    Contoh Format :
                                    081234567890</p>
                            </div>
                            <div class="mb-4">
                                <label for="message" class="block mb-2.5 text-sm font-medium text-heading">Deskripsikan
                                    Ide Kamu</label>
                                <textarea id="message" rows="4"
                                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-[#AD8331] focus:border-[#AD8331] block w-full p-3.5 shadow-xs placeholder:text-body dark:placeholder:text-gray-500"
                                    placeholder="Tuliskan ide kamu di sini..." required></textarea>
                            </div>
                            <button type="submit"
                                class="text-white bg-[#AD8331] box-border border border-transparent hover:bg-amber-500 focus:ring-4 focus:ring-[#AD8331] shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none w-full mb-3">Kirim
                                ke WhatsApp</button>
                        </form>

                        {{-- Script Forms --}}
                        <script>
                            document.getElementById('waConsultationForm').addEventListener('submit', function (e) {
                                e.preventDefault(); // Mencegah halaman reload

                                // 1. Ambil data dari input field
                                const name = document.getElementById('name').value;
                                const phone = document.getElementById('phone').value;
                                const message = document.getElementById('message').value;

                                // 2. Tentukan nomor WA Admin (Ganti dengan nomor aslimu)
                                const adminWA = "6282217427939";

                                // 3. Susun template pesan (Gunakan backticks agar format baris baru terjaga)
                                const text = `Halo Admin A4Florist, saya ingin Konsultasi Gratis:
                        
                        Nama: ${name}
                        Nomor WA: ${phone}
                        Deskripsi Ide: ${message}
                        
                        Mohon bantuannya untuk mewujudkan ide rangkaian bunga saya. Terima kasih!
                        
                        > Pesan otomatis dari Website`;

                                // 4. Encode pesan agar aman untuk URL
                                const encodedText = encodeURIComponent(text);

                                // 5. Buka tab baru menuju WhatsApp
                                window.open(`https://wa.me/${adminWA}?text=${encodedText}`, '_blank');
                            });
                        </script>
                    </div>
                </div>
            </div>

            <div class="mt-16 border-t border-gray-100 pt-8 sm:flex sm:items-center sm:justify-between lg:mt-24">
                <ul class="flex flex-wrap justify-center gap-4 text-xs">
                    <li>
                        <p class="text-white transition hover:opacity-75">
                            © 2026 A4Florist. All Rights Reserved.
                        </p>
                    </li>
                </ul>
            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
</body>

</html>