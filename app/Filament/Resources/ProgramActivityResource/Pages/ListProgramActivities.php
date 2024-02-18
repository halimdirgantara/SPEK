<?php

namespace App\Filament\Resources\ProgramActivityResource\Pages;

use App\Filament\Resources\ProgramActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProgramActivities extends ListRecords
{
    protected static string $resource = ProgramActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
