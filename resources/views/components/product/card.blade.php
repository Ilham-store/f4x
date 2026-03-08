<li class="max-sm:flex">
    <section class="block border border-[#AD8331] rounded-lg p-4 shadow-sm hover:shadow-md transition bg-white">

        <img loading="lazy" src="{{ route('product.image', basename($product->first_image)) }}"
            class="h-56 max-md:h-40 w-full rounded-md object-cover" alt="{{ $product->name }}">

        <div class="mt-3 space-y-2">

            <div class="text-xs text-gray-800">
                {{ $product->category->name }}
            </div>

            <div class="text-lg max-md:text-md font-extrabold max-md:font-bold line-clamp-2 text-black">
                {{ $product->name }}
            </div>

            <div class="text-md font-medium max-sm:font-normal text-amber-600">
                {{ $product->price_short }}
            </div>



            {{-- <div class="text-sm text-gray-500">
                IDR {{ number_format($product->price, 0, ',', '.') }}
            </div> --}}

            {{-- <a href="{{ route('first', $product->slug) }}"
                class="inline-block w-full text-center rounded-md border border-[#AD8331] bg-[#AD8331] px-4 py-2 text-sm font-medium text-white hover:bg-transparent hover:text-[#AD8331] transition">
                Check
            </a> --}}

            <a href="{{ route('productview', $product->slug) }}"
                class="inline-block w-full text-center rounded-md border border-[#AD8331] bg-[#AD8331] px-4 py-2 text-sm font-medium text-white hover:bg-transparent hover:text-[#AD8331] transition">
                Check
            </a>
        </div>
    </section>
</li>