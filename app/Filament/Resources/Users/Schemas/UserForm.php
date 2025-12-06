<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\Column;
use Illuminate\Validation\Rules\Unique;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema

            ->components([
                Section::make('Personal Informations')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('email')
                            ->label('Email address')
                            ->email()
                            ->required(),
                        // DateTimePicker::make('email_verified_at'),
                        TextInput::make('password')
                            ->password()
                            ->required()
                            ->revealable(),
                        TextInput::make('phone')
                            ->tel()
                            ->default(null),
                        Textarea::make('address')
                            ->default(null)
                            ->columnSpanFull(),
                        DatePicker::make('date_of_birth'),
                        Select::make('roles')
                            ->relationship('roles', 'name')
                            ->multiple()
                            ->preload()
                            ->required()
                            ->searchable(),
                        
                        


                    ]),
                    Section::make('Employee Details')
                            ->columns(2)
                            ->schema([
                        Select::make('department_id')
                            ->relationship('department', 'name')    
                            ->label('Department Name')
                            ->required()
                            ->searchable()
                            // ->live()
                            ->reactive()   // important!
                            ->preload(),
                        Select::make('position_id')
                            ->relationship('position','title')  
                            ->required()  
                            ->searchable()
                            ->preload()
                            ->options(function (callable $get) {
                                $departmentId = $get('department_id');

                                if (!$departmentId) {
                                    return [];
                                }

                                return \App\Models\Position::where('department_id', $departmentId)
                                    ->pluck('title', 'id');
                            })
                            ->default(null),
                        TextInput::make('employee_id')
                            ->label('Employee Code')  
                            ->readOnly()  
                            ->unique(ignoreRecord:true)
                            ->hiddenOn('create'),
                            // ->default(null),
                        
                        DatePicker::make('hire_date'),
                        Select::make('employment_type')
                            ->options([
                            'full-time' => 'Full time',
                            'part-time' => 'Part time',
                            'contract' => 'Contract',
                            'intern' => 'Intern',
                ])
                            ->default('full-time')
                            ->required(),
                        Select::make('status')
                            ->options([
                            'active' => 'Active',
                            'inactive' => 'Inactive',
                            'on-leave' => 'On leave',
                            'terminated' => 'Terminated',
                ])
                            ->default('active')
                            ->required(),
                        TextInput::make('salary')
                            ->numeric()
                            ->default(null),
                


                            ]),
                
          
                TextInput::make('emergency_contact_name')
                    ->default(null),
                TextInput::make('emergency_contact_phone')
                    ->tel()
                    ->default(null),
            ]);
    }
}
