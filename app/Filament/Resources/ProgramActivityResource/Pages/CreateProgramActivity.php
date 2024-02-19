<?php

namespace App\Filament\Resources\ProgramActivityResource\Pages;

use Goutte\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\ProgramActivityResource;

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
