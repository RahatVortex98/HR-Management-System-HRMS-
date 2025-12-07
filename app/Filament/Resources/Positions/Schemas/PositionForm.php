<?php

namespace App\Filament\Resources\Positions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PositionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                Select::make('department_id')
                    ->relationship('department','name')
                    ->preload()
                    ->required()
                    ->searchable(),
                    
                TextInput::make('min_salary')
                    ->required()
                    ->numeric()
                    ->prefix('৳'),
                TextInput::make('max_salary')
                    ->required()
                    ->numeric()
                    ->gte('min_salary')
                    ->prefix('৳'),
                TextInput::make('description')
                    ->default(null),
            ]);
    }
}
