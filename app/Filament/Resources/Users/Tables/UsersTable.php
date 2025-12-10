<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('roles.name')
                    ->label('Role')
                    // 1. Convert the text output to a colored badge
                    ->badge() 
                    ->searchable()
                    // 2. Define the color based on the role name
                    ->color(fn (string $state): string => match ($state) {
                        'employee' => 'info',     // Blue/Cyan color (Filament's default 'info')
                        'hr_manager' => 'warning', // Yellow/Amber color (Filament's default 'warning')
                        'super_admin' => 'danger',  // Red color (Filament's default 'danger')
                        default => 'gray',        // Neutral color for any other role
                    }),
                
                // TextColumn::make('email_verified_at')
                //     ->dateTime()
                //     ->sortable(),
                // TextColumn::make('created_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('department.name')
                    
                    ->sortable(),
                TextColumn::make('position.title')
                    
                    ->sortable(),
                TextColumn::make('employee_id')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('date_of_birth')
                    ->date()
                    ->sortable(),
                TextColumn::make('hire_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('emplopyment_type')
                    ->badge(),
                TextColumn::make('status'),
                TextColumn::make('salary')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('emergency_contact_name')
                    ->searchable(),
                TextColumn::make('emergency_contact_phone')
                    ->searchable(),
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
