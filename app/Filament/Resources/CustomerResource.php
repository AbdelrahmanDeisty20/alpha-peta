<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;
    protected static ?string $navigationIcon = 'icon-customer';
    protected static ?string $modelLabel = 'عميل';
    protected static ?string $pluralModelLabel = 'العملاء';
    protected static ?string $navigationLabel = 'العملاء';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('المعلومات الأساسية'))
                    ->schema([
                        Forms\Components\TextInput::make('name_ar')
                            ->label(__('الاسم بالعربية'))
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('name_en')
                            ->label(__('الاسم بالإنجليزية'))
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make(__('الوصف'))
                    ->schema([
                        Forms\Components\Textarea::make('description_ar')
                            ->label(__('الوصف بالعربية'))
                            ->required()
                            ->columnSpanFull()
                            ->rows(3),

                        Forms\Components\Textarea::make('description_en')
                            ->label(__('الوصف بالإنجليزية'))
                            ->required()
                            ->columnSpanFull()
                            ->rows(3),
                    ]),

                Forms\Components\Section::make(__('الصورة'))
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label(__('صورة العميل'))
                            ->directory('customers')
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
                    ->size(50),

                Tables\Columns\TextColumn::make('name_'.app()->getLocale())
                    ->label(__('الاسم'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('description_'.app()->getLocale())
                    ->label(__('الوصف'))
                    ->limit(50)
                    ->tooltip(function ($record) {
                        return $record->{'description_'.app()->getLocale()};
                    })
                    ->searchable(),

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
                    ->modalDescription(__('هل أنت متأكد من رغبتك في حذف هذا العميل؟'))
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
                    ->label(__('إضافة عميل جديد')),
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}