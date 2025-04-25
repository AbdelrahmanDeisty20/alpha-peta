<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegulationResource\Pages;
use App\Models\Regulation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class RegulationResource extends Resource
{
    protected static ?string $model = Regulation::class;
    protected static ?string $navigationIcon = 'icon-policy';
    protected static ?string $modelLabel = 'لائحة';
    protected static ?string $pluralModelLabel = 'اللوائح والتنظيمات';
    protected static ?string $navigationLabel = 'اللوائح';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('معلومات اللائحة'))
                    ->schema([
                        Forms\Components\FileUpload::make('file')
                            ->label(__('رفع الملف'))
                            ->directory('regulations')
                            ->preserveFilenames()
                            ->downloadable()
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\Select::make('category_id')
                            ->label(__('التصنيف'))
                            ->relationship('category', 'name_'.app()->getLocale())
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
                Tables\Columns\TextColumn::make('original_name')
                    ->label(__('اسم الملف'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category.name_'.app()->getLocale())
                    ->label(__('التصنيف'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('تاريخ الرفع'))
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label(__('تصفية حسب التصنيف'))
                    ->relationship('category', 'name_'.app()->getLocale())
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->tooltip(__('تعديل')),

                Tables\Actions\Action::make('download')
                    ->label(__('تحميل'))
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn (Regulation $record) => $record->file)
                    ->openUrlInNewTab(),

                Tables\Actions\DeleteAction::make()
                    ->tooltip(__('حذف'))
                    ->modalHeading(__('تأكيد الحذف'))
                    ->modalDescription(__('هل أنت متأكد من رغبتك في حذف هذه اللائحة؟'))
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
                    ->label(__('إضافة لائحة جديدة')),
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
            'index' => Pages\ListRegulations::route('/'),
            'create' => Pages\CreateRegulation::route('/create'),
            'edit' => Pages\EditRegulation::route('/{record}/edit'),
        ];
    }
}