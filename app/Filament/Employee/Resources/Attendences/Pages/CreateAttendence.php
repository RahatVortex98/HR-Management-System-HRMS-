<?php

namespace App\Filament\Employee\Resources\Attendences\Pages;

use App\Filament\Employee\Resources\Attendences\AttendenceResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAttendence extends CreateRecord
{
    protected static string $resource = AttendenceResource::class;
}
