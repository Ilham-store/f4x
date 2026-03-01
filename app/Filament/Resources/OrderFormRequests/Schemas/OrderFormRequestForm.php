<?php

namespace App\Filament\Resources\OrderFormRequests\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrderFormRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Produk')
                ->columns(2)
                ->schema([
                    Repeater::make('items')
                    ->relationship()
                    ->columnSpanFull()
                    ->schema([
        
                        Select::make('product_id')
                            ->relationship('product', 'name')
                            ->searchable()
                            ->required()
                            ->preload()
                            ->reactive(),
        
                        TextInput::make('quantity')
                            ->numeric()
                            ->default(1)
                            ->required(),
                    ]),
                ]),

                Section::make('Data Customer')
                    ->columns(2)
                    ->schema([

                        TextInput::make('token')
                        ->disabled()
                        ->dehydrated(),

                        TextInput::make('customer_name')->disabled(),
                        TextInput::make('customer_phone')->disabled(),
                        TextInput::make('customer_instagram')->disabled(),

                        Select::make('payment_method')
                            ->options([
                                'cash' => 'Cash',
                                'transfer' => 'Transfer',
                            ])
                            ->disabled(),

                        Select::make('pickup_method')
                            ->options([
                                'courier' => 'Kurir',
                                'self_pickup' => 'Ambil Sendiri',
                            ])
                            ->disabled(),

                        DatePicker::make('pickup_date')->disabled(),
                        TimePicker::make('pickup_time')->disabled(),

                        Textarea::make('delivery_address')
                            ->columnSpanFull()
                            ->disabled(),

                        Textarea::make('greeting_card')
                            ->columnSpanFull()
                            ->disabled(),

                        Textarea::make('balloon_message')
                            ->columnSpanFull()
                            ->disabled(),

                        Textarea::make('note')
                            ->columnSpanFull()
                            ->disabled(),
                    ])
                    ->visible(fn ($record) => $record?->status !== 'pending'),

                Section::make('Status')
                    ->schema([
                        Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'submitted' => 'Submitted',
                                'converted' => 'Converted',
                                'cancelled' => 'Cancelled',
                            ])
                            ->default('pending')
                            ->required(),
                    ]),
            ]);
    }
}
