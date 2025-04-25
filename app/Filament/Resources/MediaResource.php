<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MediaResource\Pages;
use App\Models\Media;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MediaResource extends Resource
{
    protected static ?string $model = Media::class;
    protected static ?string $navigationIcon = 'icon-media';
    protected static ?string $modelLabel = 'وسائط';
    protected static ?string $pluralModelLabel = 'الوسائط';
    protected static ?string $navigationLabel = 'الوسائط';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('معلومات الوسائط'))
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label(__('الصورة'))
                            ->image()
                            ->directory('media')
                            ->preserveFilenames()
                            ->imageEditor()
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\Select::make('service_id')
                            ->label(__('الخدمة المرتبطة'))
                            ->relationship('service', 'title_'.app()->getLocale())
                            ->preload()
                            ->searchable()
                            ->required(),
                    ])
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

                Tables\Columns\TextColumn::make('service.title_'.app()->getLocale())
                    ->label(__('الخدمة'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('تاريخ الإضافة'))
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('service')
                    ->label(__('تصفية حسب الخدمة'))
                    ->relationship('service', 'title_'.app()->getLocale())
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->tooltip(__('تعديل')),

                Tables\Actions\DeleteAction::make()
                    ->tooltip(__('حذف'))
                    ->modalHeading(__('تأكيد الحذف'))
                    ->modalDescription(__('هل أنت متأكد من رغبتك في حذف هذه الوسائط؟'))
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
                    ->label(__('إضافة وسائط جديدة')),
            ])
            ->defaultSort('created_at', 'desc');
    }

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
            'index' => Pages\ListMedia::route('/'),
            'create' => Pages\CreateMedia::route('/create'),
            'edit' => Pages\EditMedia::route('/{record}/edit'),
        ];
    }
}