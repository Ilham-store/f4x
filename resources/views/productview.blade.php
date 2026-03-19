@php
    // 1. Amankan variabel gambar dan URL
    $images = $product->images ?? [];
    $app_url_to_walink = env('APP_URL', 'https://a4florist.web.id');
    $main_image = count($images) > 0 ? route('product.image', basename($images[0])) : asset('images/a4florist_logo.svg');

    // 2. Buat array PHP murni untuk Schema Markup (Sangat aman dari Error Syntax)
    $schemaData = [
        "@context" => "https://schema.org/",
        "@type" => "Product",
        "name" => $product->name,
        "image" => $main_image,
        "description" => strip_tags($product->description),
        "sku" => "A4F-" . $product->id,
        "brand" => [
            "@type" => "Brand",
            "name" => "A4Florist"
        ],
        "offers" => [
            "@type" => "Offer",
            "url" => url()->current(),
            "priceCurrency" => "IDR",
            "price" => $product->price,
            "availability" => $product->stock > 0 ? "https://schema.org/InStock" : "https://schema.org/OutOfStock",
            "seller" => [
                "@type" => "Organization",
                "name" => "A4Florist"
            ]
        ]
    ];
@endphp

@extends('layouts.app')

@section('title', $product->name . ' - A4Florist')
@section('description', Str::limit(strip_tags($product->description), 150))
@section('og_type', 'product')
@section('og_image', $main_image)

@section('header_sekunder', true)

@push('schema')
    <script type="application/ld+json">
                        {!! json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
                        </script>
@endpush

@section('content')
    <div class="pt-20 bg-white">
        {{-- Product View --}}
        <section class="py-8 bg-white md:py-16 antialiased">
            <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
                <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">

                    {{-- Kiri: Carousel --}}
                    <div id="horizontal-thumbnails" data-carousel='{ "loadingClasses": "opacity-0" }'
                        class="relative w-full">
                        <div class="carousel">
                            <div class="carousel-body h-full opacity-0">
                                @foreach($images as $image)
                                    <div class="carousel-slide">
                                        <div class="flex size-full justify-center">
                                            <img loading="lazy" src="{{ route('product.image', basename($image)) }}"
                                                class="size-full object-contain" alt="{{ $product->name }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Slider Gambar Bawah --}}
                            @if(count($images) > 1)
                                <div
                                    class="carousel-pagination bg-base-100 absolute bottom-0 end-0 start-0 z-1 h-1/4 gap-2 flex justify-center overflow-x-auto pt-2">
                                    @foreach($images as $image)
                                        <img loading="lazy" src="{{ route('product.image', basename($image)) }}"
                                            class="carousel-pagination-item carousel-active:opacity-100 grow object-cover opacity-30 cursor-pointer"
                                            alt="Thumbnail {{ $product->name }}">
                                    @endforeach
                                </div>
                            @endif

                            @if(count($images) > 1)
                                <button type="button"
                                    class="carousel-prev start-5 max-sm:start-3 carousel-disabled:opacity-50 size-9.5 bg-base-100 flex items-center justify-center rounded-full shadow-base-300/20 shadow-sm">
                                    <span class="icon-[tabler--chevron-left] size-5 cursor-pointer"></span>
                                    <span class="sr-only">Previous</span>
                                </button>
                                <button type="button"
                                    class="carousel-next end-5 max-sm:end-3 carousel-disabled:opacity-50 size-9.5 bg-base-100 flex items-center justify-center rounded-full shadow-base-300/20 shadow-sm">
                                    <span class="icon-[tabler--chevron-right] size-5 cursor-pointer"></span>
                                    <span class="sr-only">Next</span>
                                </button>
                            @endif
                        </div>
                    </div>

                    {{-- Kanan: Detail --}}
                    <div class="mt-6 sm:mt-8 lg:mt-0">
                        {{-- Breadcrumbs --}}
                        <nav class="flex p-3 mb-4 bg-neutral-secondary-medium border border-default-medium rounded-base"
                            aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                                <li class="inline-flex items-center">
                                    <a href="/"
                                        class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-[#ad8331]">
                                        <svg class="w-4 h-4 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
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
                                        <a href="{{ env('APP_URL') . '/#product' }}"
                                            class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-[#ad8331]">Product</a>
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
                                            class="inline-flex items-center text-sm font-medium text-[#ad8331]">{{ Str::limit($product->name, 25) }}</span>
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
                                class="inline-flex max-md:mt-2 items-center px-2 py-1 ring-1 ring-inset ring-warning-subtle text-fg-warning text-sm font-medium rounded bg-warning-soft">
                                {{ $product->stock }} Pcs Tersisa
                            </span>
                        </div>

                        <div class="mt-6 sm:gap-4 sm:items-center sm:flex sm:mt-8">
                            {{-- Tombol Pesan via WhatsApp --}}
                            <a href="https://wa.me/6282217427939?text={{ urlencode('Halo Admin A4Florist, saya ingin konfirmasi ketersediaan produk berikut:' . "\n\n" . 'Nama Produk: ' . $product->name . "\n" . 'Harga Produk : ' . $product->price_short . "\n" . 'Link Produk : ' . $app_url_to_walink . '/product/' . $product->slug . "\n\n" . 'Mohon info apakah stok masih tersedia. Terima kasih!' . "\n\n" . '> Pesan ini otomatis dari Website') }}"
                                title="Pesan {{ $product->name }} via WhatsApp"
                                class="shadow-md text-white text-shadow-lg text-lg gap-2 mt-4 sm:mt-0 bg-[#25D366] hover:bg-[#075E54] focus:ring-4 focus:ring-[#128C7E] font-medium rounded-[10px] px-5 py-2.5 focus:outline-none flex items-center justify-center"
                                role="button" target="_blank" rel="noopener noreferrer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-whatsapp" viewBox="0 0 16 16">
                                    <path
                                        d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                                </svg>
                                Pesan via WhatsApp
                            </a>
                        </div>

                        <hr class="my-6 md:my-8 border-gray-200">

                        <span class="bg-warning-soft text-fg-warning text-sm font-medium px-2 py-1 rounded">
                            {{ $product->category->name ?? 'Kategori Umum' }}
                        </span>

                        <div class="mt-4 mb-6 text-gray-700 whitespace-pre-line leading-relaxed">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
@endpush