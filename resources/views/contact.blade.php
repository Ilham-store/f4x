@extends('layouts.app')

{{-- Inject Data SEO Spesifik untuk Halaman Contact --}}
@section('title', 'A4Florist | Hubungi Kami')
@section('description', 'Hubungi A4Florist untuk pemesanan, custom buket, atau pertanyaan seputar pengiriman di area Sengkang dan Kabupaten Wajo.')
@section('og_type', 'website')

@section('header_sekunder', true)

@section('content')
    {{-- Contact Detail --}}
    <section class="bg-white pt-20">
        <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-sm min-h-[75vh]">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 ">Contact Us
            </h2>
            <p class="mb-8 lg:mb-16 font-light text-center text-gray-500 sm:text-xl">Mengalami
                masalah teknis? Ingin mengirimkan masukan tentang fitur beta? Butuh detail tentang produk kami? Beri
                tahu kami.
            </p>
            <ul class="my-6 space-y-3">
                <li>
                    <a href="https://wa.me/6282217427939"
                        class="flex items-center p-3 text-lg font-semibold text-heading rounded-base bg-neutral-secondary-medium hover:bg-neutral-tertiary-medium group"
                        target="_blank">
                        <img src="/images/WhatsApp.svg" alt="WhatsApp Logo" class="h-8">
                        <span class="flex-1 ms-3 whitespace-nowrap">WhatsApp</span>
                        <span
                            class="bg-neutral-primary-soft border border-default-medium text-heading text-xs font-medium px-1.5 py-0.5 rounded-sm">Popular</span>
                    </a>
                </li>
                <li>
                    <a href="https://www.instagram.com/a4florist"
                        class="flex items-center p-3 text-lg font-semibold text-heading rounded-base bg-neutral-secondary-medium hover:bg-neutral-tertiary-medium group"
                        target="_blank">
                        <img src="/images/Instagram.svg" alt="Instagram Logo" class="h-7">
                        <span class="flex-1 ms-3 whitespace-nowrap">Instagram</span>
                    </a>
                </li>
            </ul>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
@endpush