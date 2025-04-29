<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use Illuminate\Database\Eloquent\Model;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditService extends EditRecord
{
    protected static string $resource = ServiceResource::class;

    protected function getSavedNotificationTitle(): ?string
    {
        return __('Blog Updated Successfully');
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['media'] = $this->record->media->pluck('image')->toArray();
        return $data;
    }


    protected function afterSave(): void
    {
        $record = $this->record;
        if (isset($this->data['media'])) {
            $record->media()->whereNotIn('image', $this->data['media'])->delete();    //بيسمح الصور القديمه

            foreach ($this->data['media'] as $image) {
                $exists = $record->media()->where('image', $image)->exists(); // ملهاش  لازمه
                if (!$exists) {
                    $record->media()->create([
                        'image' => $image,
                    ]);
                }
            }
        }
    }
}
