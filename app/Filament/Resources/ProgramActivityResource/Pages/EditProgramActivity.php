<?php

namespace App\Filament\Resources\ProgramActivityResource\Pages;

use App\Filament\Resources\ProgramActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProgramActivity extends EditRecord
{
    protected static string $resource = ProgramActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
