<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/images/a4florist_logo.svg" type="image/svg+xml">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <title>Berhasil - Form Pesanan Terkirim</title>
</head>

<body class="bg-gray-100 pt-40">
    <div class=" px-4 mx-auto max-w-screen-md grid auto-rows-max place-items-center h-screen">
        <img class="h-35 max-md:h-20 mb-5 bg-amber-100 p-5 max-md:p-3 rounded-full" src="/images/a4florist_logo.svg"
            alt="Logo A4Florist">
        <h2 class="text-4xl tracking-tight font-extrabold text-center text-gray-900">🎉 Form Pesanan Berhasil
            Dikirim!
        </h2>
        <p class="mt-4 font-light text-center text-gray-600 sm:text-xl">Terima kasih telah melakukan pemesanan.
        </p>

        <p class="font-light text-center text-gray-600 sm:text-xl mb-4">Tim kami akan segera memproses pesanan
            Anda. Dan menghubungi anda kembali melalui Whatsapp.
        </p>
        <a href="https://wa.me/6282217427939?text={{ urlencode('Halo Admin A4Florist, Form Pemesanan dari halaman ' . url()->current() . ' sudah berhasil terkirim. Mohon dilanjutkan pemesanannya.') }}"
            title=""
            class="shadow-md text-white text-shadow-lg text-lg gap-2 hover:text-white mt-4 sm:mt-0 bg-[#25D366] hover:bg-[#075E54] focus:ring-4 focus:ring-[#128C7E] font-medium rounded-[10px] px-5 py-2.5 focus:outline-none  flex items-center justify-center"
            role="button" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp"
                viewBox="0 0 16 16">
                <path
                    d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
            </svg>
            Informasikan Ke WhatsApp
        </a>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
</body>

</html>