<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('images')
                    ->image()
                    ->required()
                    ->multiple()
                    ->maxParallelUploads(5)
                    ->directory('products')
                    ->reorderable()
                    ->nullable()
                    ->optimize('webp', 70)
                    ->resize(60)
                    ->columnSpanFull(),

                TextInput::make('name')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('slug', Str::slug($state));
                    }),

                TextInput::make('slug')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('slug', Str::slug($state));
                    })
                    ->unique(ignoreRecord: true)
                    ->helperText('Slug otomatis diformat: huruf kecil & strip.'),

                Textarea::make('description')
                    ->columnSpanFull()
                    ->rows(5),

                TextInput::make('price')
                    ->numeric()
                    ->required()
                    ->prefix('Rp'),

                TextInput::make('stock')
                    ->numeric()
                    ->required(),

                Select::make('category_id')
                    ->relationship('category', 'name', modifyQueryUsing: fn ($query) => $query->where('is_active', true))
                    ->required()
                    ->searchable()
                    ->preload(),

                ToggleButtons::make('is_active')
                    ->label('Is Active ?')
                    ->boolean()
                    ->required()
                    ->inline()
                    ->default(true),

            ]);
    }
}
