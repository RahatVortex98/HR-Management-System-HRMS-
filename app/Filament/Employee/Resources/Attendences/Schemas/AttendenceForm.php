<?php

namespace App\Filament\Employee\Resources\Attendences\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class AttendenceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                DatePicker::make('date')
                    ->required(),
                TimePicker::make('check_in'),
                TimePicker::make('check_out'),
                Select::make('status')
                    ->options(['present' => 'Present', 'absent' => 'Absent', 'late' => 'Late', 'half-day' => 'Half day'])
                    ->default('present')
                    ->required(),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
