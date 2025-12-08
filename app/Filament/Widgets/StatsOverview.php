<?php

namespace App\Filament\Widgets;

use App\Models\Attendence;
use App\Models\Department;
use App\Models\LeaveRequest;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
class StatsOverview extends StatsOverviewWidget
{
    protected ?string $pollingInterval = '60s';//widgets refresh their data every 60 seconds.
    protected function getStats(): array
    {
        return [
            Stat::make('Total Employees', User::count())
                ->description('Total Active Employee')
                ->descriptionIcon('heroicon-o-users')
                ->color('success'),
            Stat::make('Total Deparment',Department::count())
                ->description('Available Department')
                ->descriptionIcon('heroicon-o-building-office')
                ->color('info'),
            Stat::make('Pending Leave Requests', LeaveRequest::where('status','pending')->count())
                ->description('Awating Approval')
                ->descriptionIcon('heroicon-o-calendar-days')
                ->color('warning'),
            Stat::make('Today\'s Attendence',Attendence::where('date',today())->count())
                ->description('Checked-In Today')
                ->descriptionIcon('heroicon-o-clock')
                ->color('primary'),
           
        ];
    }
}
