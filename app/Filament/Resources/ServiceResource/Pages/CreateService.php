<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateService extends CreateRecord
{
    protected static string $resource = ServiceResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getCreatedNotificationTitle(): ?string
    {
        return __('Blog Created Successfully');
    }
    protected function afterCreate(): void
{
    if (is_array($this->data['media'])) {
        foreach ($this->data['media'] as $mediaPath) {
            $this->record->media()->create([
                'image' => $mediaPath,
            ]);
        }
    }
}
}
