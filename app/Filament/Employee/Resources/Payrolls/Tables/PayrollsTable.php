<?php

namespace App\Filament\Employee\Resources\Payrolls\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class PayrollsTable
{
    public static function configure(Table $table): Table
    {
        // Get the logged-in user once
        $user = Auth::user();

        return $table
            ->modifyQueryUsing(function (Builder $query) use ($user) {
                // Filter payrolls for logged-in user
                if ($user) {
                    return $query->where('user_id', $user->id);
                }
                return $query;
            })
            ->columns([
                TextColumn::make('user.name') // Show user name instead of ID
                    ->sortable(),
                TextColumn::make('month'),
                TextColumn::make('year')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('basic_salary')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('allowances')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('deductions')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('bonus')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('net_salary')
                    ->numeric()
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
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // DeleteBulkAction::make(),
                ]),
            ]);
    }
}
