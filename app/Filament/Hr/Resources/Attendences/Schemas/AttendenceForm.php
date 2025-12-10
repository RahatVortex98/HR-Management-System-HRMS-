<?php

namespace App\Filament\Hr\Resources\Attendences\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Schema;

class AttendenceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user','name')
                    ->preload()
                    ->searchable(),
                DatePicker::make('date')
                    ->required(),
                TimePicker::make('check_in')
                            ->prefix('pm'),
                TimePicker::make('check_out')
                            ->prefix('pm'),
                ToggleButtons::make('status')
                    ->options(['present' => 'Present', 'absent' => 'Absent', 'late' => 'Late', 'half-day' => 'Half day'])
                    ->default('present')
                    ->grouped()
                    ->colors([
                        'present'=>'success',
                        'absent'=>'danger',
                        'late'=>'warning',
                        'half-day'=>'info',
                    ])
                    ->required(),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
