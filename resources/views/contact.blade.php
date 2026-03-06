<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/images/a4florist_logo.svg" type="image/svg+xml">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <title>Contact - A4Florist</title>
</head>

<body>
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

    {{-- Contact Forms --}}
    <section class="bg-white dark:bg-gray-900 pt-20">
        <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Contact Us
            </h2>
            <p class="mb-8 lg:mb-16 font-light text-center text-gray-500 dark:text-gray-400 sm:text-xl">Mengalami
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

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
</body>

</html>