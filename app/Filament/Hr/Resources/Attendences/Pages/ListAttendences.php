<?php

namespace App\Filament\Hr\Resources\Attendences\Pages;

use App\Filament\Hr\Resources\Attendences\AttendenceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAttendences extends ListRecords
{
    protected static string $resource = AttendenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
