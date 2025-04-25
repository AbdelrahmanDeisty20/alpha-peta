<?php

namespace App\Filament\Resources\RegulationResource\Pages;

use App\Filament\Resources\RegulationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRegulation extends CreateRecord
{
    protected static string $resource = RegulationResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getCreatedNotificationTitle(): ?string
    {
        return __('Blog Created Successfully');
    }
}
