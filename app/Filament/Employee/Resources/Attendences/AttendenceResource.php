<?php

namespace App\Filament\Employee\Resources\Attendences;

use App\Filament\Employee\Resources\Attendences\Pages\CreateAttendence;
use App\Filament\Employee\Resources\Attendences\Pages\EditAttendence;
use App\Filament\Employee\Resources\Attendences\Pages\ListAttendences;
use App\Filament\Employee\Resources\Attendences\Schemas\AttendenceForm;
use App\Filament\Employee\Resources\Attendences\Tables\AttendencesTable;
use App\Models\Attendence;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
class AttendenceResource extends Resource
{
    protected static ?string $model = Attendence::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Clock;
     protected static string|UnitEnum|null $navigationGroup = 'Attendences';
    public static function form(Schema $schema): Schema
    {
        return AttendenceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AttendencesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAttendences::route('/'),
            'create' => CreateAttendence::route('/create'),
            'edit' => EditAttendence::route('/{record}/edit'),
        ];
    }
}
