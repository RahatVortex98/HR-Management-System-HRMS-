<?php

namespace App\Filament\Hr\Resources\Payrolls\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Forms;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class PayrollsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Employee')
                    ->sortable(),
                    
                TextColumn::make('user.employee_id')
                    ->label('Employee Code'),

                TextColumn::make('month'),

                TextColumn::make('year')
                    ->sortable(),

                TextColumn::make('basic_salary')
                    ->numeric()
                    ->money('BDT')
                    ->sortable(),

                TextColumn::make('allowances')
                    ->numeric()
                    ->money('BDT')
                    ->sortable(),

                TextColumn::make('deductions')
                    ->numeric()
                    ->money('BDT')
                    ->sortable(),

                TextColumn::make('bonus')
                    ->numeric()
                    ->money('BDT')
                    ->sortable(),

                TextColumn::make('net_salary')
                    ->numeric()
                    ->money('BDT')
                    ->sortable(),

                TextColumn::make('status'),

                TextColumn::make('paid_at')
                    ->date()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            // -------------------------
            // 🔍 FILTERS (Month + Year + Employee)
            // -------------------------
            ->filters([
                Filter::make('period_filter')
                    ->label('Filter by Period')
                    ->form([
                        Forms\Components\Select::make('month')
                            ->label('Month')
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
                            ->searchable(),

                        Forms\Components\TextInput::make('year')
                            ->label('Year')
                            ->numeric()
                            ->minValue(2000)
                            ->maxValue(2100),

                        Forms\Components\Select::make('user_id')
                            ->label('Employee')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload(),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['month'] ?? null, fn ($q, $month) =>
                                $q->where('month', $month)
                            )
                            ->when($data['year'] ?? null, fn ($q, $year) =>
                                $q->where('year', $year)
                            )
                            ->when($data['user_id'] ?? null, fn ($q, $user) =>
                                $q->where('user_id', $user)
                            );
                    }),
            ])

            // -------------------------
            // 🔧 RECORD ACTIONS
            // -------------------------
            ->recordActions([
                EditAction::make(),
            ])

            // -------------------------
            // 🧹 BULK ACTIONS
            // -------------------------
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
