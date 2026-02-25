<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;

class RevenueChart extends ChartWidget
{
    protected ?string $heading = 'Revenue (Last 7 Days)';

    protected function getData(): array
    {
        $data = collect(range(6, 0))->map(function ($day) {
            return Order::whereDate('order_date', now()->subDays($day))
                ->sum('total_amount');
        });

        return [
            'datasets' => [
                [
                    'label' => 'Revenue',
                    'data' => $data,
                ],
            ],
            'labels' => collect(range(6, 0))
                ->map(fn ($day) => now()->subDays($day)->format('d M')),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
