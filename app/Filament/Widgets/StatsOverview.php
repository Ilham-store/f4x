<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Revenue This Month',
                'Rp ' . number_format(
                    Order::whereMonth('order_date', now()->month)->sum('total_amount'),
                    0, ',', '.'
                )
            ),

            Stat::make('Orders This Month',
                Order::whereMonth('order_date', now()->month)->count()
            ),

            Stat::make('Pending Orders',
                Order::where('status', 'pending')->count()
            ),

            Stat::make('Total Products',
                Product::count()
            ),

            Stat::make('Revenue Today',
                'Rp ' . number_format(
                    Order::whereDate('order_date', today())->sum('total_amount'),
                    0, ',', '.'
                )
            ),
        ];
    }
}
