<?php

namespace App\Filament\Hr\Resources\Payrolls\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PayrollForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload(),

                Select::make('month')
                    ->options([
                        'jan' => 'Jan',
                        'feb' => 'Feb',
                        'mar' => 'Mar',
                        'apr' => 'Apr',
                        'may' => 'May',
                        'jun' => 'Jun',
                        'jul' => 'Jul',
                        'aug' => 'Aug',
                        'sep' => 'Sep',
                        'oct' => 'Oct',
                        'nov' => 'Nov',
                        'dec' => 'Dec',
                    ])
                    ->required(),

                TextInput::make('year')
                    ->required()
                    ->numeric(),

                TextInput::make('basic_salary')
                    ->numeric()
                    ->required()
                    ->prefix('৳')
                    ->live(onBlur:true)
                    ->afterStateUpdated(function ($set, $get) {
                        $set('net_salary',
                            ($get('basic_salary') ?? 0)
                            + ($get('allowances') ?? 0)
                            + ($get('bonus') ?? 0)
                            - ($get('deductions') ?? 0)
                        );
                    }),

                TextInput::make('allowances')
                    ->numeric()
                    ->default(0)
                    ->live(onBlur:true)
                    ->prefix('৳')
                    ->afterStateUpdated(function ($set, $get) {
                        $set('net_salary',
                            ($get('basic_salary') ?? 0)
                            + ($get('allowances') ?? 0)
                            + ($get('bonus') ?? 0)
                            - ($get('deductions') ?? 0)
                        );
                    }),

                TextInput::make('deductions')
                    ->numeric()
                    ->default(0)
                    ->live(onBlur:true)
                    ->prefix('৳')
                    ->afterStateUpdated(function ($set, $get) {
                        $set('net_salary',
                            ($get('basic_salary') ?? 0)
                            + ($get('allowances') ?? 0)
                            + ($get('bonus') ?? 0)
                            - ($get('deductions') ?? 0)
                        );
                    }),

                TextInput::make('bonus')
                    ->numeric()
                    ->default(0)
                    ->live(onBlur:true)
                    ->prefix('৳')
                    ->afterStateUpdated(function ($set, $get) {
                        $set('net_salary',
                            ($get('basic_salary') ?? 0)
                            + ($get('allowances') ?? 0)
                            + ($get('bonus') ?? 0)
                            - ($get('deductions') ?? 0)
                        );
                    }),

                TextInput::make('net_salary')
                    ->numeric()
                    ->required()
                    ->readOnly()
                    ->prefix('৳')
                    ->afterStateHydrated(function ($state, $set, $get) {
                        $set('net_salary',
                            ($get('basic_salary') ?? 0)
                            + ($get('allowances') ?? 0)
                            + ($get('bonus') ?? 0)
                            - ($get('deductions') ?? 0)
                        );
                    }),

                Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'processed' => 'Processed',
                        'paid' => 'Paid',
                    ])
                    ->default('draft')
                    ->required(),

                DatePicker::make('paid_at'),
            ]);
    }
}
