<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSettings;
use Cheesegrits\FilamentGoogleMaps\Fields\Map;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class Settings extends SettingsPage
{
    protected static ?string $navigationIcon = 'icon-setting';
    protected static string $settings = GeneralSettings::class;

    public function getMaxContentWidth(): ?string
    {
        return 'full';
    }

    public static function getNavigationGroup(): ?string
    {
        return __('الإعدادات');
    }

    public static function getNavigationLabel(): string
    {
        return __('الإعدادات العامة');
    }

    public function getTitle(): string
    {
        return __('الإعدادات العامة');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('الإعدادات')
                    ->columnSpanFull()
                    ->tabs([
                        $this->generalInfoTab(),
                        $this->aboutPageTab(),
                    ])
            ]);
    }

    protected function generalInfoTab(): Forms\Components\Tabs\Tab
    {
        return Forms\Components\Tabs\Tab::make(__('المعلومات الأساسية'))
            ->schema([
                // اسم الموقع عربي
                Forms\Components\TextInput::make('web_name_ar')
                    ->label(__('اسم الموقع (عربي)'))
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                // اسم الموقع إنجليزي
                Forms\Components\TextInput::make('web_name_en')
                    ->label(__('اسم الموقع (إنجليزي)'))
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                // البريد الإلكتروني
                Forms\Components\TextInput::make('email')
                    ->label(__('البريد الإلكتروني'))
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                // رقم الهاتف
                Forms\Components\TextInput::make('phone')
                    ->label(__('رقم الهاتف'))
                    ->required()
                    ->maxLength(20)
                    ->columnSpanFull(),

                // واتساب
                Forms\Components\TextInput::make('whatsapp')
                    ->label(__('واتساب'))
                    ->required()
                    ->maxLength(20)
                    ->columnSpanFull(),

                // الموقع الإلكتروني
                Forms\Components\TextInput::make('website')
                    ->label(__('الموقع الإلكتروني'))
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                // فيسبوك
                Forms\Components\TextInput::make('facebook')
                    ->label(__('فيسبوك'))
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                // تويتر
                Forms\Components\TextInput::make('twitter')
                    ->label(__('تويتر'))
                    ->maxLength(255)
                    ->columnSpanFull(),

                // إنستجرام
                Forms\Components\TextInput::make('instagram')
                    ->label(__('إنستجرام'))
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                // لينكدإن
                Forms\Components\TextInput::make('linkedin')
                    ->label(__('لينكدإن'))
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                // الشعار الكبير
                Forms\Components\FileUpload::make('big_image')
                    ->label(__('الشعار الكبير'))
                    ->image()
                    ->directory('settings')
                    ->required()
                    ->columnSpanFull(),

                // العنوان
                Forms\Components\TextInput::make('address')
                    ->label(__('العنوان'))
                    ->required()
                    ->maxLength(500)
                    ->columnSpanFull(),

                // الخريطة
                Map::make('location')
                    ->label(__('الموقع على الخريطة'))
                    ->columnSpanFull()
                    ->height('400px')
                    ->defaultZoom(5)
                    ->autocomplete('address'),

                // وصف التذييل عربي
                Forms\Components\Textarea::make('decs_footer_ar')
                    ->label(__('وصف التذييل (عربي)'))
                    ->rows(3)
                    ->required()
                    ->columnSpanFull(),

                // وصف التذييل إنجليزي
                Forms\Components\Textarea::make('decs_footer_en')
                    ->label(__('وصف التذييل (إنجليزي)'))
                    ->rows(3)
                    ->required()
                    ->columnSpanFull(),

                // الشعار الرئيسي
                Forms\Components\FileUpload::make('logo')
                    ->label(__('الشعار الرئيسي'))
                    ->image()
                    ->directory('settings')
                    ->required()
                    ->columnSpanFull(),

                // شعار التذييل
                Forms\Components\FileUpload::make('footer_logo')
                    ->label(__('شعار التذييل'))
                    ->image()
                    ->directory('settings')
                    ->required()
                    ->columnSpanFull(),

                // أيقونة الموقع
                Forms\Components\FileUpload::make('favicon')
                    ->label(__('أيقونة الموقع'))
                    ->image()
                    ->directory('settings')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    protected function aboutPageTab(): Forms\Components\Tabs\Tab
    {
        return Forms\Components\Tabs\Tab::make(__('صفحة من نحن'))
            ->schema([
                // الوصف الأول عربي
                Forms\Components\Textarea::make('about_desc_one_ar')
                    ->label(__('الوصف الأول (عربي)'))
                    ->rows(3)
                    ->required()
                    ->columnSpanFull(),

                // الوصف الأول إنجليزي
                Forms\Components\Textarea::make('about_desc_one_en')
                    ->label(__('الوصف الأول (إنجليزي)'))
                    ->rows(3)
                    ->required()
                    ->columnSpanFull(),

                // الوصف الثاني عربي
                Forms\Components\Textarea::make('about_desc_two_ar')
                    ->label(__('الوصف الثاني (عربي)'))
                    ->rows(3)
                    ->required()
                    ->columnSpanFull(),

                // الوصف الثاني إنجليزي
                Forms\Components\Textarea::make('about_desc_two_en')
                    ->label(__('الوصف الثاني (إنجليزي)'))
                    ->rows(3)
                    ->required()
                    ->columnSpanFull(),

                // الرؤية عربي
                Forms\Components\Textarea::make('vision_ar')
                    ->label(__('الرؤية (عربي)'))
                    ->rows(2)
                    ->required()
                    ->columnSpanFull(),

                // الرؤية إنجليزي
                Forms\Components\Textarea::make('vision_en')
                    ->label(__('الرؤية (إنجليزي)'))
                    ->rows(2)
                    ->required()
                    ->columnSpanFull(),

                // الرسالة عربي
                Forms\Components\Textarea::make('message_ar')
                    ->label(__('الرسالة (عربي)'))
                    ->rows(2)
                    ->required()
                    ->columnSpanFull(),

                // الرسالة إنجليزي
                Forms\Components\Textarea::make('message_en')
                    ->label(__('الرسالة (إنجليزي)'))
                    ->rows(2)
                    ->required()
                    ->columnSpanFull(),

                // الهدف عربي
                Forms\Components\Textarea::make('goal_ar')
                    ->label(__('الهدف (عربي)'))
                    ->rows(2)
                    ->required()
                    ->columnSpanFull(),

                // الهدف إنجليزي
                Forms\Components\Textarea::make('goal_en')
                    ->label(__('الهدف (إنجليزي)'))
                    ->rows(2)
                    ->required()
                    ->columnSpanFull(),

                // الصورة الأولى
                Forms\Components\FileUpload::make('about_image_one')
                    ->label(__('الصورة الأولى'))
                    ->image()
                    ->directory('settings')
                    ->required()
                    ->columnSpanFull(),

                // الصورة الثانية
                Forms\Components\FileUpload::make('about_image_two')
                    ->label(__('الصورة الثانية'))
                    ->image()
                    ->directory('settings')
                    ->required()
                    ->columnSpanFull(),

                // الصورة الثالثة
                Forms\Components\FileUpload::make('about_image_three')
                    ->label(__('الصورة الثالثة'))
                    ->image()
                    ->directory('settings')
                    ->required()
                    ->columnSpanFull(),

                // الصورة الرابعة
                Forms\Components\FileUpload::make('about_image_four')
                    ->label(__('الصورة الرابعة'))
                    ->image()
                    ->directory('settings')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}