<?php

namespace App\Filament\Hr\Resources\LeaveRequests\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class LeaveRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('user_id')
                    ->relationship('user','name')
                    ->searchable()
                    ->required()
                    ->preload(),
                // TextInput::make('approved_by')
                //     ->numeric()
                //     ->default(null),
                Select::make('leave_type_id')
                    ->relationship('leaveType','name')
                    ->required()
                    ->searchable()
                    ->preload(),
                // TimePicker::make('start_time'),
                    
                // TimePicker::make('end_time'),
                TextInput::make('days')
                    ->required()
                    ->numeric(),
                Textarea::make('reason')
                    ->required()
                    ->columnSpanFull(),
                Select::make('status')
                    ->options(['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'])
                    ->default('pending')
                    ->live()
                    ->required(),
                DateTimePicker::make('approved_at'),
                Textarea::make('rejection_reason')
                    ->default(null)
                    ->columnSpanFull()
                    ->visible(fn(Get $get)=>$get('status')==='rejected'),
            ]);
    }
}
