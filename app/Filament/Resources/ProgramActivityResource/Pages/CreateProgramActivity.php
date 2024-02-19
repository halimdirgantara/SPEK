<?php

namespace App\Filament\Resources\ProgramActivityResource\Pages;

use App\Filament\Resources\ProgramActivityResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateProgramActivity extends CreateRecord
{
    protected static string $resource = ProgramActivityResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();

        return $data;
    }
}
