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
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="none" viewBox="0 0 24 24">
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
                <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">
                        <h3 class="text-lg font-medium text-heading">
                            Form Konsultasi Gratis
                        </h3>
                        <button type="button"
                            class="text-gray-500 bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center"
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
                                    class="block w-full ps-9 pe-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-[#AD8331] focus:border-[#AD8331] shadow-xs placeholder:text-gray-500"
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
                                    class="block w-full ps-9 pe-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-[#AD8331] focus:border-[#AD8331] shadow-xs placeholder:text-gray-500"
                                    pattern="(08|628)[0-9]{8,11}" placeholder="081234567890" required />
                            </div>
                            <p id="helper-text-explanation" class="mt-2.5 text-sm text-gray-500">
                                Contoh Format :
                                081234567890</p>
                        </div>
                        <div class="mb-4">
                            <label for="message" class="block mb-2.5 text-sm font-medium text-heading">Deskripsikan
                                Ide Kamu</label>
                            <textarea id="message" rows="4"
                                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-[#AD8331] focus:border-[#AD8331] block w-full p-3.5 shadow-xs placeholder:text-gray-500"
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