<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Models\Blog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;
    protected static ?string $modelLabel = null;
    protected static ?string $navigationIcon = 'icon-blogger';

public static function getModelLabel(): string
{
    return __('مقال');
}

public static function getPluralModelLabel(): string
{
    return __('المقالات');
}

public static function getNavigationLabel(): string
{
    return __('المقالات');
}

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('المحتوى العربي'))
                    ->schema([
                        Forms\Components\TextInput::make('title_ar')
                            ->label(__('العنوان'))
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Forms\Components\Textarea::make('content_ar')
                            ->label(__('المحتوى'))
                            ->required()
                            ->columnSpanFull()
                            ->rows(5),
                    ])
                    ->columns(2),

                Forms\Components\Section::make(__('English Content'))
                    ->schema([
                        Forms\Components\TextInput::make('title_en')
                            ->label(__('Title'))
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Forms\Components\Textarea::make('content_en')
                            ->label(__('Content'))
                            ->required()
                            ->columnSpanFull()
                            ->rows(5),
                    ])
                    ->columns(2),

                Forms\Components\Section::make(__('إعدادات المقال'))
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label(__('صورة المقال'))
                            ->image()
                            ->directory('blog')
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
                    ->label(__('المحتوى'))
                    ->limit(50)
                    ->html()
                    ->tooltip(function ($record) {
                        $content = $record->{'content_'.app()->getLocale()};
                        return new HtmlString(strip_tags($content));
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('تاريخ الإنشاء'))
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
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
                    ->modalDescription(__('هل أنت متأكد من رغبتك في حذف هذا المقال؟'))
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
                    ->label(__('إضافة مقال جديد')),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}