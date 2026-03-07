@php
    $images = $product->images ?? [];
    $app_url_to_walink = env('APP_URL');
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/images/a4florist_logo.svg" type="image/svg+xml">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <title>{{ $product->name }}</title>
</head>

<body class="bg-white">
    {{-- Header --}}
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
                            <a class="text-gray-500 transition hover:text-gray-500/75" href={{ env('APP_URL') . "/#product" }}> Product </a>
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
                            <li><a class="dropdown-item" href={{ env('APP_URL') . "/#product" }}>Product</a></li>
                            <li><a class="dropdown-item hidden" href="#">Blog</a></li>
                            <li><a class="dropdown-item hidden" href="#">About</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- Product View --}}
    <div class="pt-20">
        {{-- Product View --}}
        <section class="py-8 bg-white md:py-16 antialiased">
            <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
                <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
                    <div id="horizontal-thumbnails" data-carousel='{ "loadingClasses": "opacity-0" }'
                        class="relative w-full">
                        <div class="carousel">
                            <div class="carousel-body h-full opacity-0">
                                <!-- Slide Repeter -->
                                @foreach($product->images as $image)

                                    <div class="carousel-slide">
                                        <div class="flex size-full justify-center">
                                            <img src="{{ route('product.image', basename($image)) }}"
                                                class="size-full object-contain" alt="{{ $product->name }}">
                                        </div>
                                    </div>

                                @endforeach
                            </div>

                            {{-- Slider Gambar Bawah --}}
                            @if(count($images) > 1)
                                <div
                                    class="carousel-pagination bg-base-100 absolute bottom-0 end-0 start-0 z-1 h-1/4 gap-2 flex justify-center gap-2 overflow-x-auto pt-2">
                                    @foreach($product->images as $image)

                                        <img src="{{ route('product.image', basename($image)) }}"
                                            class="carousel-pagination-item carousel-active:opacity-100 grow object-cover opacity-30"
                                            alt="{{ $product->name }}">

                                    @endforeach
                                </div>
                            @endif

                            <!-- Previous Slide -->
                            @if(count($images) > 1)
                                <button type="button"
                                    class="carousel-prev start-5 max-sm:start-3 carousel-disabled:opacity-50 size-9.5 bg-base-100 flex items-center justify-center rounded-full shadow-base-300/20 shadow-sm">
                                    <span class="icon-[tabler--chevron-left] size-5 cursor-pointer"></span>
                                    <span class="sr-only">Previous</span>
                                </button>
                                <!-- Next Slide -->
                                <button type="button"
                                    class="carousel-next end-5 max-sm:end-3 carousel-disabled:opacity-50 size-9.5 bg-base-100 flex items-center justify-center rounded-full shadow-base-300/20 shadow-sm">
                                    <span class="icon-[tabler--chevron-right] size-5"></span>
                                    <span class="sr-only">Next</span>
                                </button>
                            @endif
                        </div>
                    </div>


                    <div class="mt-6 sm:mt-8 lg:mt-0">
                        {{-- Breadcrumbs --}}
                        <nav class="flex p-3 mb-4 bg-neutral-secondary-medium border border-default-medium rounded-base"
                            aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                                <li class="inline-flex items-center">
                                    <a href="/"
                                        class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-[#ad8331]">
                                        <svg class="w-4 h-4 me-1.5" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
                                        </svg>
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <div class="flex items-center space-x-1.5">
                                        <svg class="w-3.5 h-3.5 rtl:rotate-180 text-gray-600" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m9 5 7 7-7 7" />
                                        </svg>
                                        <h5
                                            class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-[#ad8331]">
                                            Product</h5>
                                    </div>
                                </li>
                                <li aria-current="page">
                                    <div class="flex items-center space-x-1.5">
                                        <svg class="w-3.5 h-3.5 rtl:rotate-180 text-gray-600" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m9 5 7 7-7 7" />
                                        </svg>
                                        <span
                                            class="inline-flex items-center text-sm font-medium text-[#ad8331]">{{ $product->name }}</span>
                                    </div>
                                </li>
                            </ol>
                        </nav>


                        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">
                            {{ $product->name }}
                        </h1>
                        <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
                            <p class="text-2xl font-extrabold text-gray-900 sm:text-3xl">
                                {{ $product->price_short }}
                            </p>
                            <span
                                class="inline-flex max-md:mt-2 items-center px-2 py-1 ring-1 ring-inset ring-warning-subtle text-fg-warning text-sm font-medium rounded bg-warning-soft">{{ $product->stock }}
                                Pcs Tersisa</span>
                        </div>

                        <div class="mt-6 sm:gap-4 sm:items-center sm:flex sm:mt-8">
                            {{-- <a href="#" title=""
                                class="flex items-center justify-center py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                                role="button">
                                <svg class="w-5 h-5 -ms-2 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                                </svg>
                                Add to favorites
                            </a> --}}
                            <a href="https://wa.me/6282217427939?text={{ urlencode(" Halo Admin A4Florist, saya ingin
                                konfirmasi ketersediaan produk berikut:\n\nNama Produk: " . $product->name . " \nHarga
                                Produk : " . $product->price_short . " \nLink Produk : " . $app_url_to_walink . " /product/" . $product->slug . "\n\nMohon info apakah stok masih tersedia. Terima
                                kasih!\n\n> Pesan ini otomatis dari Website") }}" title="" class="shadow-md text-white text-shadow-lg text-lg gap-2 hover:text-white mt-4 sm:mt-0
                                bg-[#25D366] hover:bg-[#075E54] focus:ring-4 focus:ring-[#128C7E] font-medium
                                rounded-[10px] px-5 py-2.5 focus:outline-none  flex items-center justify-center"
                                role="button" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-whatsapp" viewBox="0 0 16 16">
                                    <path
                                        d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                                </svg>
                                Pesan via WhatsApp
                            </a>
                        </div>

                        <hr class="my-6 md:my-8 border-gray-200" />

                        <span
                            class="bg-warning-soft text-fg-warning text-sm font-medium px-2 py-1 rounded">{{ $product->category->name }}</span>
                        <p class="mb-6 text-gray-700  whitespace-pre-line">
                            {{ $product->description }}
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>

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