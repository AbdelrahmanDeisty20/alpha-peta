<?php

use App\Models\User;
use App\Settings\GeneralSettings;
use Filament\Notifications\Events\DatabaseNotificationsSent;
use Filament\Notifications\Notification as FilamentNotification;
use Filament\Notifications\Actions\Action;

function getSetting($key, $lang = null)
{
    $generalSettings = app(abstract: GeneralSettings::class);

    if ($lang == null) {
        $property = $key;
    } else {
        $property = $key . '__' . $lang;
    }

    return $generalSettings->$property ?? null;
}
function transWord($word, $lang = null)
{

    if (!$lang) {
        $lang = app()->getLocale();
    }

    $translationsFile = 'translations.json';

    // Check if the translations file exists, and create it if not
    if (!file_exists($translationsFile)) {
        file_put_contents($translationsFile, json_encode([], JSON_PRETTY_PRINT));
    }

    // Load existing translations from the JSON file
    $translations = json_decode(file_get_contents($translationsFile), true);

    // Check if the translation already exists for the given word and locale
    if (isset($translations[$lang][$word])) {
        $translatedWord = $translations[$lang][$word];
    } else {
        // If not found, translate the word
        $translateClient = new \Stichoza\GoogleTranslate\GoogleTranslate();
        $translatedWord = $translateClient->setSource(null)->setTarget($lang)->translate($word);

        // Save the translated word to the JSON file
        $translations[$lang][$word] = $translatedWord;
        file_put_contents($translationsFile, json_encode($translations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    return $translatedWord;
}
function sendNotifyAdmin($title, $label, $route)
{
    $admin = User::where('id',1)->first();
    FilamentNotification::make()
        ->title($title)
        ->actions([
            Action::make('view')
                ->label($label)
                ->button()

                ->url(function () use ($route) {
                    return $route;
                })
                ->markAsRead()

        ])
        // ->broadcast(User::role('admin')->first());
        ->sendToDatabase($admin);

    event(new DatabaseNotificationsSent($admin));
}