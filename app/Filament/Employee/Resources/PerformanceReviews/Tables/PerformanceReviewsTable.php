<?php

namespace App\Filament\Employee\Resources\PerformanceReviews\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class PerformanceReviewsTable
{
    public static function configure(Table $table): Table
    {
        $user = Auth::user(); // Get logged-in user

        return $table
            ->modifyQueryUsing(function (Builder $query) use ($user) {
                // Show only reviews for the logged-in employee
                if ($user) {
                    return $query->where('user_id', $user->id);
                }
                return $query;
            })
            ->columns([
                TextColumn::make('user.name') // Display employee name
                    ->label('Employee')
                    ->sortable(),

                TextColumn::make('reviewer.name') // Display reviewer name
                    ->label('Reviewer')
                    ->sortable(),

                TextColumn::make('review_period')
                    ->searchable(),

                TextColumn::make('quality_of_work')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('productivity')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('communication')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('teamwork')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('leadership')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('overall_rating')
                    ->numeric()
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
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
