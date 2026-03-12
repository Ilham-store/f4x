@php
    use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <title>Invoice {{ $order->order_number }}</title>
    @vite('resources/css/app.css')
    <style>
        @media print {

            @page {
                size: A4;
            }

            tbody tr:nth-child(even) {
                background-color: #f9fafb !important;
            }

            body {
                margin: 0;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .status-badge {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                font-weight: 700;
            }

            thead {
                background-color: #1f2937 !important;
                color: white !important;
            }

            th {
                background-color: #1f2937 !important;
                color: white !important;
            }
        }
    </style>
</head>

<body class="bg-gray-100 py-10 print:bg-white print:py-0">

    <div id="invoice-card" class="relative max-w-4xl mx-auto shadow-xl rounded-2xl
            print:shadow-none print:rounded-none print:max-w-full">

        <div class="absolute inset-0 bg-white rounded-2xl print:rounded-none"></div>

        @php
            $watermarkColors = [
                'paid' => 'text-green-500',
                'pending' => 'text-yellow-500',
                'processing' => 'text-blue-500',
                'cancelled' => 'text-red-500',
            ];

            $watermarkClass = $watermarkColors[$order->status] ?? 'text-gray-400';
        @endphp

        {{-- Watermark --}}
        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
            <span class="text-[140px] font-extrabold opacity-[0.06] rotate-[-30deg] {{ $watermarkClass }}">
                {{ strtoupper($order->status) }}
            </span>
        </div>

        <div class="relative z-10 p-10">
            {{-- HEADER --}}
            <div class="flex items-center gap-4">
                <img src="{{ asset('images/logo.svg') }}" alt="a4florist logo" class="h-14 block object-contain">

                <div>
                    <h1 class="text-xl font-bold text-gray-800">
                        A4florist
                    </h1>
                    <p class="text-sm text-gray-500">
                        Jl. Poros Tancung - Saloki, Rumpia, Kec. Majauleng, Kab. Wajo
                    </p>
                    <p class="text-sm text-gray-500">
                        0822-1742-7939
                    </p>
                </div>
            </div>

            {{-- INFO --}}
            <div class="grid grid-cols-2 gap-6 mt-8">


                <div>
                    <p class="text-sm text-gray-500">
                        Invoice Number
                    </p>
                    <h2 class="text-xl font-bold text-gray-800">
                        {{ $order->order_number }}
                    </h2>

                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide pt-3">
                        Bill To
                    </h3>

                    <p class="mt-2 font-semibold text-gray-800">
                        {{ $order->customer_name }}
                    </p>

                    <p class="text-gray-600 text-sm">
                        {{ $order->customer_phone }}
                    </p>

                    @if($order->customer_instagram)
                        <p class="text-gray-600 text-sm">
                            Instagram: {{ '@' . $order->customer_instagram }}
                        </p>
                    @endif

                    <p class="text-gray-600 text-sm">
                        {{ $order->delivery_address }}
                    </p>
                </div>

                <div class="text-right">
                    <p class="text-sm text-gray-500">
                        Order Date
                    </p>
                    <p class="font-medium text-gray-800">
                        {{ Carbon::parse($order->order_date)->format('d M Y') }}
                    </p>

                    <p class="text-sm text-gray-500 mt-4">
                        Handled By
                    </p>
                    <p class="font-medium text-gray-800">
                        {{ $order->user->name ?? '-' }}
                    </p>

                    {{-- STATUS BADGE --}}
                    @php
                        $statusClasses = [
                            'paid' => 'text-green-700 border-green-700 bg-green-100',
                            'pending' => 'text-yellow-700 border-yellow-700 bg-yellow-100',
                            'processing' => 'text-blue-700 border-blue-700 bg-blue-100',
                            'cancelled' => 'text-red-700 border-red-700 bg-red-100',
                        ];

                        $statusClass = $statusClasses[$order->status] ?? 'text-gray-700 border-gray-700 bg-gray-100';
                    @endphp

                    <div class="mt-4">
                        <span class="text-sm text-gray-500 block mb-1">Status</span>

                        <span
                            class="inline-block px-4 py-1 text-sm font-semibold rounded-full border-2 {{ $statusClass }} print:border-black print:text-black">
                            {{ strtoupper($order->status) }}
                        </span>
                    </div>
                    <div class="mt-6 text-sm text-gray-700 space-y-2">

                        <div class="flex justify-between">
                            <span class="text-gray-500">Payment Method</span>
                            <span class="font-medium">
                                {{ ucfirst($order->payment_method) }}
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-500">Pickup Method</span>
                            <span class="font-medium">
                                {{ $order->pickup_method === 'self_pickup' ? 'Ambil Sendiri' : 'Kurir' }}
                            </span>
                        </div>

                        @if($order->pickup_date)
                            <div class="flex justify-between">
                                <span class="text-gray-500">Pickup Date</span>
                                <span class="font-medium">
                                    {{ Carbon::parse($order->pickup_date)->format('d M Y') }}
                                </span>
                            </div>
                        @endif

                        @if($order->pickup_time)
                            <div class="flex justify-between">
                                <span class="text-gray-500">Pickup Time</span>
                                <span class="font-medium">
                                    {{ Carbon::parse($order->pickup_time)->format('H:i') }} WITA
                                </span>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

            {{-- ITEMS TABLE --}}
            <div class="mt-10">
                <table class="w-full text-sm border border-gray-200 rounded-lg overflow-hidden">

                    <thead
                        class="bg-gray-800 text-white text-xs uppercase tracking-wide print:bg-gray-800 print:text-white">
                        <tr>
                            <th class="px-4 py-3 text-left">Product</th>
                            <th class="px-4 py-3 text-right">Qty</th>
                            <th class="px-4 py-3 text-right">Unit Price</th>
                            <th class="px-4 py-3 text-right">Total</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">

                        @foreach($order->items as $index => $item)
                            <tr class="{{ $index % 2 == 0 ? 'bg-gray-50' : 'bg-white' }}">
                                <td class="px-4 py-3 text-gray-800 font-medium">
                                    {{ $item->product->name ?? '-' }}
                                </td>

                                <td class="px-4 py-3 text-right text-gray-600">
                                    {{ $item->quantity }}
                                </td>

                                <td class="px-4 py-3 text-right text-gray-600">
                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                </td>

                                <td class="px-4 py-3 text-right font-semibold text-gray-800">
                                    Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            {{-- TOTAL SECTION --}}
            <div class="mt-8 flex justify-end">
                <div class="w-96 bg-gray-50 p-6 rounded-xl border">

                    {{-- SUBTOTAL --}}
                    <div class="flex justify-between text-sm text-gray-600 mb-2">
                        <span>Subtotal</span>
                        <span>
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </span>
                    </div>

                    {{-- EXTRA COST --}}
                    @if($order->extra_cost > 0)
                        <div class="flex justify-between text-sm text-gray-600 mb-2">
                            <span>Biaya Tambahan</span>
                            <span>
                                Rp {{ number_format($order->extra_cost, 0, ',', '.') }}
                            </span>
                        </div>
                    @endif

                    {{-- DISCOUNT --}}
                    @if($order->discount_value > 0)
                        <div class="flex justify-between text-sm text-red-600 mb-2">
                            <span>
                                Diskon
                                @if($order->discount_type === 'percent')
                                    ({{ $order->discount_value }}%)
                                @endif
                            </span>

                            <span>
                                - Rp
                                @php
                                    $discountAmount = $order->discount_type === 'percent'
                                        ? $order->total_amount * ($order->discount_value / 100)
                                        : $order->discount_value;
                                @endphp

                                {{ number_format($discountAmount, 0, ',', '.') }}
                            </span>
                        </div>
                    @endif

                    {{-- GRAND TOTAL --}}
                    <div class="border-t pt-3 flex justify-between text-xl font-bold text-gray-900">
                        <span>Grand Total</span>
                        <span>
                            Rp {{ number_format($order->grand_total, 0, ',', '.') }}
                        </span>
                    </div>

                </div>
            </div>

            {{-- NOTE --}}
            @if($order->note)
                <div class="mt-8 bg-gray-50 p-4 rounded-lg">
                    <h4 class="text-sm font-semibold text-gray-500 uppercase">
                        Note
                    </h4>
                    <p class="text-sm text-gray-700 mt-2">
                        {{ $order->note }}
                    </p>
                </div>
            @endif

            @if($order->greeting_card)
                <div class="mt-8 bg-gray-50 p-4 rounded-lg">
                    <h4 class="text-sm font-semibold text-gray-500 uppercase">
                        Greeting Card
                    </h4>
                    <p class="text-sm text-gray-700 mt-2 whitespace-pre-line">
                        {{ $order->greeting_card }}
                    </p>
                </div>
            @endif


            @if($order->balloon_message)
                <div class="mt-6 bg-gray-50 p-4 rounded-lg">
                    <h4 class="text-sm font-semibold text-gray-500 uppercase">
                        Ucapan di Balon
                    </h4>
                    <p class="text-sm text-gray-700 mt-2 whitespace-pre-line">
                        {{ $order->balloon_message }}
                    </p>
                </div>
            @endif


            {{-- FOOTER --}}
            <div class="mt-16 pt-6 border-t text-center text-xs text-gray-500 leading-relaxed">

                <p class="font-medium text-gray-700">
                    Thank you for choosing {{ config('app.name') }}.
                </p>

                <p>
                    This invoice is system-generated and does not require a signature.
                </p>

                <p class="mt-2">
                    If you have any questions regarding this invoice, please contact our support team.
                </p>

            </div>
        </div>
    </div>

    <div class="pt-10 flex flex-row max-w-4xl mx-auto w-full rounded-2xl
    no-print print:hidden gap-2.5">
        <button type="button"
            class="basis-[50%] px-4 py-4 bg-[#AD8331] text-white text-md font-semibold rounded-lg hover:bg-gray-700 inline-flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
            </svg>
            <a href="{{ env('APP_URL') }}/admin/orders">
                Kembali ke Halaman Orders
            </a>
        </button>

        <button onclick="window.print()"
            class="basis-[50%] px-4 py-4 bg-gray-700 text-white text-md font-semibold rounded-lg hover:bg-[#AD8331] inline-flex flex-row-reverse items-center gap-2">
            <span>Print Invoice</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
            </svg>
        </button>
    </div>
</body>

</html>