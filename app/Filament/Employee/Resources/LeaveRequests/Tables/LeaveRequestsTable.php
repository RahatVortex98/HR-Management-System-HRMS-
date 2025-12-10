<?php

namespace App\Filament\Employee\Resources\LeaveRequests\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class LeaveRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Employee')
                    ->sortable(),

                TextColumn::make('leaveType.name')
                    ->label('Leave Type')
                    ->sortable(),

                TextColumn::make('start_time')
                    ->time()
                    ->sortable(),

                TextColumn::make('end_time')
                    ->time()
                    ->sortable(),

                TextColumn::make('days')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('status')
                    ->colors([
                        'success' => 'approved',
                        'danger'  => 'rejected',
                        'warning' => 'pending',
                    ])
                    ->sortable(),

                TextColumn::make('approver.name')
                    ->label('Approver')
                    ->sortable(),

                TextColumn::make('approved_at')
                    ->dateTime()
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
                // EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // DeleteBulkAction::make(),
                ]),
            ]);
    }

    // Ensure relationships are loaded for the table
      public static function getQuery(): Builder
    {
        return \App\Models\LeaveRequest::query()->with(['user', 'leaveType', 'approver']);
    }
}
