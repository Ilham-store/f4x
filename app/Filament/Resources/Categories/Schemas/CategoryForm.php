<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\Column;
use Illuminate\Support\Str;



class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
            TextInput::make('name')
            ->columnSpanFull()
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(fn ($state, callable $set) =>
                    $set('slug', Str::slug($state))
                ),

            TextInput::make('slug')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(function ($state, callable $set) {
                    $set('slug', Str::slug($state));
                })
                ->unique(ignoreRecord: true)
                ->helperText('Slug otomatis diformat: huruf kecil & strip.'),
            
            ToggleButtons::make('is_active')
                ->label('Is Active ?')
                ->boolean()
                ->inline()
                ->default(true)
                ->required(),
            ]);
    }
}
