<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice {{ $order->order_number }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
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

    <div class="relative max-w-4xl mx-auto shadow-xl rounded-2xl
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

            {{-- INVOICE PRINT --}}
            <div class="flex justify-end gap-3 mb-6 no-print print:hidden">
                <button onclick="window.print()"
                    class="px-4 py-2 bg-gray-800 text-white text-sm rounded-lg hover:bg-gray-700">
                    Print
                </button>
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
                    <p class="text-gray-600 text-sm">
                        {{ $order->delivery_address }}
                    </p>
                </div>

                <div class="text-right">
                    <p class="text-sm text-gray-500">
                        Order Date
                    </p>
                    <p class="font-medium text-gray-800">
                        {{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}
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
                <div class="w-80 bg-gray-50 p-6 rounded-xl border">

                    <div class="flex justify-between text-sm text-gray-600 mb-2">
                        <span>Subtotal</span>
                        <span>
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="border-t pt-3 flex justify-between text-xl font-bold text-gray-900">
                        <span>Grand Total</span>
                        <span>
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
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

</body>

</html>