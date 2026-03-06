@php
    $images = $product->images ?? [];
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

<body>
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

    <div class="pt-20">
        {{-- Product View --}}
        <section class="py-8 bg-white md:py-16 dark:bg-gray-900 antialiased">
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
                                        class="inline-flex items-center text-sm font-medium text-body hover:text-[#ad8331]">
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
                                        <svg class="w-3.5 h-3.5 rtl:rotate-180 text-body" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m9 5 7 7-7 7" />
                                        </svg>
                                        <h5
                                            class="inline-flex items-center text-sm font-medium text-body hover:text-[#ad8331]">
                                            Product</h5>
                                    </div>
                                </li>
                                <li aria-current="page">
                                    <div class="flex items-center space-x-1.5">
                                        <svg class="w-3.5 h-3.5 rtl:rotate-180 text-body" aria-hidden="true"
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


                        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                            {{ $product->name }}
                        </h1>
                        <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
                            <p class="text-2xl font-extrabold text-gray-900 sm:text-3xl dark:text-white">
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
                            <a href="https://wa.me/6282217427939?text={{ urlencode("Halo Admin A4Florist, saya ingin konfirmasi ketersediaan produk berikut:\n\nNama Produk: " . $product->name . "\nHarga Produk : " . $product->price_short . "\nLink Produk : " . env('APP_URL') . "/product/" . $product->slug . "\n\nMohon info apakah stok masih tersedia. Terima kasih!\n\n> Pesan ini otomatis dari Website") }}"
                                title=""
                                class="shadow-md text-white text-shadow-lg text-lg gap-2 hover:text-white mt-4 sm:mt-0 bg-[#25D366] hover:bg-[#075E54] focus:ring-4 focus:ring-[#128C7E] font-medium rounded-[10px] px-5 py-2.5 dark:bg-[#075E54] dark:hover:bg-[#075E54] focus:outline-none dark:focus:ring-amber-800 flex items-center justify-center"
                                role="button" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-whatsapp" viewBox="0 0 16 16">
                                    <path
                                        d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                                </svg>
                                Pesan via WhatsApp
                            </a>
                        </div>

                        <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-800" />

                        <span
                            class="bg-warning-soft text-fg-warning text-sm font-medium px-2 py-1 rounded">{{ $product->category->name }}</span>
                        <p class="mb-6 text-gray-500 dark:text-gray-400 whitespace-pre-line">
                            {{ $product->description }}
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
</body>

</html>