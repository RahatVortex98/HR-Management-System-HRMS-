<?php

namespace App\Filament\Resources\Departments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DepartmentForm
{
     public static function configure(Schema $schema): Schema
 {
return $schema
 ->components([

 Section::make('Department Informations')
 ->columns(2)
->columnSpanFull()
 ->schema([
 TextInput::make('name')
 ->required(),

                                // 👇 FIXED: Use the foreign key 'manager_id'
                                Select::make('manager_id') 
 ->relationship('manager','name')
 ->preload()
->label('Manager')
 ->searchable()
 ->default(null),
 Textarea::make('description')
 ->default(null)
 ->columnSpanFull(),


 ]),

 
 ]);
 }
}