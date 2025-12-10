<?php

namespace App\Filament\Employee\Pages;

use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use App\Models\Attendence;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use BackedEnum;


use UnitEnum;
class CheckInOut extends Page
{
    use HasPageShield;

    protected string $view = 'filament.employee.pages.check-in-out';
    protected static string | BackedEnum | null $navigationIcon = Heroicon::ArrowPath;
    protected static string | UnitEnum | null $navigationGroup = 'Attendences';
    public $todayAttendence;
    public $canCheckIn = false;
    public $canCheckOut = false;
    public $currentTime;

    public function mount(): void
    {
        $this->loadAttendence();
        $this->currentTime = now()->format('h:i A'); // Display current time in 12-hour format
    }

    /**
     * Load today's attendance for the logged-in user
     */
    public function loadAttendence(): void
    {
        $userId = Auth::id(); // Use Auth::id() to avoid Intelephense warnings

        $this->todayAttendence = Attendence::where('user_id', $userId)
            ->whereDate('date', today())
            ->first();

        // Determine whether the user can check in or check out
        $this->canCheckIn = !$this->todayAttendence || $this->todayAttendence->check_in === null;
        $this->canCheckOut = $this->todayAttendence && $this->todayAttendence->check_in !== null && $this->todayAttendence->check_out === null;
    }

    /**
     * Handle user check-in
     */
    public function checkIn(): void
    {
        try {
            if (!$this->canCheckIn) {
                return;
            }

            $this->todayAttendence = Attendence::create([
                'user_id' => Auth::id(),
                'date' => today(),
                'check_in' => now(),
                'status' => now()->format('H:i') > '09:00' ? 'late' : 'present',
            ]);

            Notification::make()
                ->success()
                ->title('Checked In Successfully')
                ->body('Your check-in time: ' . now()->format('h:i A'))
                ->send();

            $this->loadAttendence();
        } catch (\Exception $e) {
            Notification::make()
                ->danger()
                ->title('Check-in Failed')
                ->body('You have already checked in today.')
                ->send();
        }
    }

    /**
     * Handle user check-out
     */
    public function checkOut(): void
    {
        if ($this->todayAttendence) {
            $this->todayAttendence->update([
                'check_out' => now(),
            ]);

            Notification::make()
                ->success()
                ->title('Checked Out Successfully')
                ->body('Your check-out time: ' . now()->format('h:i A'))
                ->send();

            $this->loadAttendence();
        }
    }

    /**
     * Header actions for Check-In and Check-Out buttons
     */
    protected function getHeaderActions(): array
    {
        return [
            Action::make('checkIn')
                ->label('Check In')
                ->icon('heroicon-o-arrow-right-on-rectangle')
                ->color('success')
                ->visible(fn () => $this->canCheckIn)
                ->requiresConfirmation()
                ->modalHeading('Check In')
                ->modalDescription('Are you sure you want to check in now?')
                ->modalSubmitActionLabel('Yes, Check In')
                ->action(fn () => $this->checkIn()),

            Action::make('checkOut')
                ->label('Check Out')
                ->icon('heroicon-o-arrow-left-on-rectangle')
                ->color('danger')
                ->visible(fn () => $this->canCheckOut)
                ->requiresConfirmation()
                ->modalHeading('Check Out')
                ->modalDescription('Are you sure you want to check out now?')
                ->modalSubmitActionLabel('Yes, Check Out')
                ->action(fn () => $this->checkOut()),
        ];
    }
}





