<?php

namespace App\Filament\Employee\Resources\LeaveRequests\Schemas;

use Filament\Forms\Components\DatePicker; // Changed to DatePicker
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth; // <-- Import Auth

class LeaveRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // 1. Employee Name (Auto-Populated and Disabled)
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->default(Auth::id()) // <-- AUTO POPULATE WITH LOGGED-IN USER ID
                    ->disabled()          // <-- USER CANNOT CHANGE THIS
                    ->dehydrated()        // <-- Ensure the value is saved to the database
                    ->required()
                    ->label('Employee Name'),

                // 2. Leave Type Selection (Improved)
                Select::make('leave_type_id')
                    ->relationship('leaveType', 'name') // Assuming you have a LeaveType model/relationship
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Leave Type'), // e.g., Annual, Sick, Personal

                // 3. Start Date (Use DatePicker)
                DatePicker::make('start_date')
                    // ->required()
                    ->native(false) // Better UX for date selection
                    ->minDate(now()) // Cannot request leave in the past
                  
                    ->columnSpan(1),
                    
                // 4. End Date (Use DatePicker)
                DatePicker::make('end_date')
                    // ->required()
                    ->native(false)
                   
                    ->columnSpan(1),

                // 5. Total Days (Suggestion: Calculate this field)
                TextInput::make('days')
                    ->required()
                    ->numeric()
                    ->placeholder('e.g., 2.5')
                    ->hint('Total days requested (can be calculated automatically with Livewire)'),
                    
                // 6. Reason
                Textarea::make('reason')
                    ->required()
                    ->rows(5) // Improved UX
                    ->placeholder('State the detailed reason for your leave.')
                    ->columnSpanFull(),
                    
                // 7. Status (Hidden from Employee)
                // Employees should not set the status; it should default and be managed by HR.
                // We leave it here for initial creation but hide the component.
                Select::make('status')
                    ->options(['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'])
                    ->default('pending')
                    ->hidden() // Hide from the employee
                    ->dehydrated()
                    ->required(),
                    
                // 8. Approval Fields (Remove or Hide)
                // Employees should not see or fill these fields.
                // These should only be visible/editable in the HR Manager Panel.
                // To keep them in the schema but ensure security:
                TextInput::make('rejection_reason')
                    ->hidden()
                    ->dehydrated(false)
                    ->default(null),
                
                DatePicker::make('approved_at')
                    ->hidden()
                    ->dehydrated(false),
            ]);
    }
}