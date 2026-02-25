<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
    <title>Beranda</title>
</head>

<body>
    <section class="bg-[#faf8f6] py-24">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-16 items-center">

            {{-- TEXT --}}
            <div>
                <h1 class="text-5xl md:text-6xl font-serif font-semibold text-gray-800 leading-tight">
                    Elegant Flowers <br>
                    for Every <span class="text-[#b76e79]">Special Moment</span>
                </h1>

                <p class="mt-6 text-lg text-gray-600 leading-relaxed">
                    Handcrafted premium bouquets designed to make every occasion unforgettable.
                    Fresh flowers, curated with love and delivered with care.
                </p>

                <div class="mt-8 flex gap-4">
                    <a href="#products" class="px-6 py-3 bg-[#b76e79] text-white rounded-full text-sm tracking-wide
                              hover:bg-[#9f5c66] transition duration-300 shadow-md">
                        Shop Now
                    </a>

                    <a href="#about" class="px-6 py-3 border border-gray-400 text-gray-700 rounded-full text-sm tracking-wide
                              hover:bg-gray-100 transition duration-300">
                        Learn More
                    </a>
                </div>
            </div>

            {{-- IMAGE --}}
            <div class="relative">
                <img src="{{ asset('images/hero-bouquet.jpg') }}"
                    class="rounded-3xl shadow-2xl object-cover w-full h-[500px]" alt="Premium Bouquet">
            </div>

        </div>
    </section>

</body>

</html>