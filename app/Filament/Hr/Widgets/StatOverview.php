<?php

namespace App\Filament\Hr\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Attendence;
use App\Models\LeaveRequest;
use App\Models\Payroll;

class StatOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make(
                'Total Present Today',
                Attendence::where('status', 'present')
                    ->whereDate('date', today())
                    ->count()
            )
            ->description('Total present employees today')
             ->descriptionIcon('heroicon-o-users'),
            Stat::make(
                'Pending Request',
                LeaveRequest::where('status', 'pending')->count())
            
            ->description('Requires Action')
            ->descriptionIcon('heroicon-o-calendar-days'),
            Stat::make(
                'This Month Payroll',
                Payroll::where('month', date('F'))
                ->where('year',date('Y'))
                ->where('status','paid')
                ->count()
            )
            ->description('Process This Month')
            ->descriptionIcon('heroicon-o-banknotes'),
        ];
    }
}
