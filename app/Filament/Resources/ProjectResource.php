<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static ?string $navigationIcon = 'icon-project';
    protected static ?string $modelLabel = 'مشروع';
    protected static ?string $pluralModelLabel = 'المشاريع';
    protected static ?string $navigationLabel = 'المشاريع';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('المحتوى العربي'))
                    ->schema([
                        Forms\Components\TextInput::make('title_ar')
                            ->label(__('عنوان المشروع'))
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('content_ar')
                            ->label(__('وصف المشروع'))
                            ->required()
                            ->columnSpanFull()
                            ->rows(3),
                    ]),

                Forms\Components\Section::make(__('المحتوى الإنجليزي'))
                    ->schema([
                        Forms\Components\TextInput::make('title_en')
                            ->label(__('Project Title'))
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('content_en')
                            ->label(__('Project Description'))
                            ->required()
                            ->columnSpanFull()
                            ->rows(3),
                    ]),

                Forms\Components\Section::make(__('صورة المشروع'))
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label(__('صورة رئيسية'))
                            ->directory('projects')
                            ->image()
                            ->preserveFilenames()
                            ->imageEditor()
                            ->required()
                            ->columnSpanFull(),
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

                Tables\Columns\TextColumn::make('title_'.app()->getLocale())
                    ->label(__('العنوان'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('content_'.app()->getLocale())
                    ->label(__('الوصف'))
                    ->limit(50)
                    ->html()
                    ->tooltip(function ($record) {
                        $content = $record->{'content_'.app()->getLocale()};
                        return new HtmlString(strip_tags($content));
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('تاريخ الإنشاء'))
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
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date)
                            )
                            ->when(
                                $data['created_until'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date)
                            );
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->tooltip(__('تعديل')),

                Tables\Actions\DeleteAction::make()
                    ->tooltip(__('حذف'))
                    ->modalHeading(__('تأكيد الحذف'))
                    ->modalDescription(__('هل أنت متأكد من رغبتك في حذف هذا المشروع؟'))
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
                    ->label(__('إضافة مشروع جديد')),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}