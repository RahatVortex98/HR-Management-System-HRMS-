<?php

namespace App\Filament\Hr\Resources\LeaveRequests\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\Textarea;
class LeaveRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('approved_by')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('leave_type_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('start_time')
                    ->date()
                    ->sortable(),
                TextColumn::make('end_time')
                    ->date()
                    ->sortable(),
                TextColumn::make('days')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status'),
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
    EditAction::make(),

    Action::make('approve')
        ->label('Approve')
        ->color('success')
        ->icon('heroicon-o-check')
        ->requiresConfirmation()
        ->visible(fn ($record) => $record->status === 'pending')   
        ->action(function ($record) {
            $record->update([
                'status' => 'approved',
            ]);
            Notification::make()
            ->success()
            ->title('Leave Approved')
            ->send();
        }),
        
    Action::make('reject')
            ->label('Reject')
            ->color('danger')
            ->icon('heroicon-o-x-circle')
            ->modalHeading('Reject Leave Request')
            ->visible(fn ($record) => $record->status === 'pending')
            ->schema([
                Textarea::make('rejection_reason')
                    ->label('Rejection Reason')
                    ->required()
                    ->rows(3),
            ])
    ->action(function ($record, array $data) {
        $record->update([
            'status' => 'rejected',
            'rejection_reason' => $data['rejection_reason'],
        ]);

        Notification::make()
            ->danger()
            ->title('Leave Rejected')
            ->body('The leave request has been rejected.')
            ->send();
    })

])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
