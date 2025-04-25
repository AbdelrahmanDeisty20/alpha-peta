<?php

namespace App\Filament\Resources\RegulationResource\Pages;

use App\Filament\Resources\RegulationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRegulation extends EditRecord
{
    protected static string $resource = RegulationResource::class;

    protected function getSavedNotificationTitle(): ?string
    {
        return __('Blog Updated Successfully');
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
