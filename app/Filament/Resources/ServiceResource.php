<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Media;
use App\Models\Service;
use Filament\Infolists\Components\ImageEntry;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Form;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\Livewire;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section as InfolistSection;
use Filament\Resources\Resource;
use Filament\Infolists\Infolist;

use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;
    protected static ?string $navigationIcon = 'icon-service';
    protected static ?string $modelLabel = 'خدمة';
    protected static ?string $pluralModelLabel = 'الخدمات';
    protected static ?string $navigationLabel = 'الخدمات';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // المحتوى العربي
                Forms\Components\Section::make(__('المحتوى العربي'))
                    ->schema([
                        Forms\Components\TextInput::make('title_ar')
                            ->label(__('عنوان الخدمة'))
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('content_ar')
                            ->label(__('وصف الخدمة'))
                            ->required()
                            ->columnSpanFull()
                            ->rows(3),
                    ]),

                // المحتوى الإنجليزي
                Forms\Components\Section::make(__('المحتوى الإنجليزي'))
                    ->schema([
                        Forms\Components\TextInput::make('title_en')
                            ->label(__('Service Title'))
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('content_en')
                            ->label(__('Service Description'))
                            ->required()
                            ->columnSpanFull()
                            ->rows(3),
                    ]),

                // صورة الخدمة الرئيسية
                Forms\Components\Section::make(__('صورة الخدمة'))
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label(__('الصورة الرئيسية'))
                            ->directory('services')
                            ->image()
                            ->preserveFilenames()
                            ->imageEditor()
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Section::make(__('الصور الإضافية'))
                            ->schema([
                                Forms\Components\FileUpload::make('media')
                                    ->label(__('الصور الإضافية'))
                                    ->multiple()  // للسماح برفع أكثر من صورة
                                    ->disk('public')
                                    ->directory('media')
                                    ->preserveFilenames()
                                    ->required()
                                    ->columnSpanFull()
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label(__('الصورة'))
                    ->circular()
                    ->size(60),

                Tables\Columns\TextColumn::make('title_' . app()->getLocale())
                    ->label(__('العنوان'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('content_' . app()->getLocale())
                    ->label(__('الوصف'))
                    ->limit(50)
                    ->html()
                    ->tooltip(function ($record) {
                        $content = $record->{'content_' . app()->getLocale()};
                        return new HtmlString(strip_tags($content));
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('تاريخ الإضافة'))
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label(__('من تاريخ')),
                        Forms\Components\DatePicker::make('created_until')
                            ->label(__('إلى تاريخ')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'] ?? null,
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date)
                            )
                            ->when(
                                $data['created_until'] ?? null,
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date)
                            );
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->tooltip(__('تعديل')),
                Tables\Actions\ViewAction::make()
                    ->tooltip(__('عرض')),


                Tables\Actions\DeleteAction::make()
                    ->tooltip(__('حذف'))
                    ->modalHeading(__('تأكيد الحذف'))
                    ->modalDescription(__('هل أنت متأكد من رغبتك في حذف هذه الخدمة؟'))
                    ->modalSubmitActionLabel(__('نعم، احذفه'))
                    ->modalCancelActionLabel(__('إلغاء')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label(__('حذف المحدد')),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label(__('إضافة خدمة جديدة')),
            ])
            ->defaultSort('created_at', 'desc');
    }

    // protected function afterCreate($data): void
    // {
    //     // Runs after the form fields are saved to the database.

    //     $service = Service::create($data); // حفظ بيانات الخدمة

    //     // حفظ الصور في جدول media
    //     if (isset($data['media'])) {
    //         foreach ($data['media'] as $mediaItem) {
    //             $service->media()->create([
    //                 'image' => $mediaItem['image']->store('media', 'public'), // حفظ الصورة في مجلد media
    //             ]);
    //         }

    //     }
    //     // return $service;
    // }
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getModelLabel(): string
    {
        return __(static::$modelLabel);
    }

    public static function getPluralModelLabel(): string
    {
        return __(static::$pluralModelLabel);
    }

    public static function getNavigationLabel(): string
    {
        return __(static::$navigationLabel);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
            'view' => Pages\viewService::route('/{record}'),
        ];
    }
    public static function infolist(Infolist $infolist): Infolist
{
    return $infolist
        ->schema([
            InfolistSection::make(__('Service Information'))
                ->description(__('About the service'))
                ->schema([
                    TextEntry::make('title_' . app()->getLocale())
                        ->label(__('Title')),

                    TextEntry::make('content_' . app()->getLocale())
                        ->label(__('Content')),

                    Fieldset::make(__('Service Image'))
                        ->schema([
                            Livewire::make('service-image', ['image' => $infolist->record])
                        ])
                        ->columns(1),

                    InfolistSection::make(__('Additional Images'))
                        ->description(__('Other images related to the service'))
                        ->collapsible()
                        ->schema([
                            Fieldset::make(__('Gallery'))
                                ->schema([
                                    Livewire::make('display-image', ['media' => $infolist->record])
                                ])
                                ->columns(1),
                        ]),

                    TextEntry::make('created_at')
                        ->label(__('Created At'))
                        ->dateTime(),
                ])
                ->columns(2),
        ]);
}

}
