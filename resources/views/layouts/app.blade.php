<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'A4Florist | Toko Buket Bunga, Buket Uang, dan Parcel Terbaik di Wajo')</title>

    <link rel="icon" href="/images/a4florist_logo.svg" type="image/svg+xml">
    <meta name="robots" content="@yield('robots', 'index, follow')">

    <meta name="description"
        content="@yield('description', 'Pemesanan buket bunga, buket uang, dan parcel di Sengkang, Kabupaten Wajo. Layanan cepat, desain elegan, dan harga terjangkau.')">

    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'A4Florist')">
    <meta property="og:description"
        content="@yield('description', 'Pemesanan Buket Bunga, Buket Uang, dan Parcel berkualitas.')">
    <meta property="og:image" content="@yield('og_image', asset('images/Slide-1.svg'))">

    <meta name="twitter:card" content="summary_large_image">

    @stack('schema')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
    @if(View::hasSection('header_sekunder'))
        @include('partials.header-sekunder')
    @else
        @include('partials.header-utama')
    @endif

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    @livewireScripts
    @stack('scripts')
</body>

</html>