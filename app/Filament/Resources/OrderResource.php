<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Contact;
use App\Models\Order;
use Filament\Forms;
use Filament\Infolists\Components\Section as infoListSectionOrder; 
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationIcon = 'icon-orders';
    protected static ?string $modelLabel = 'طلب';
    protected static ?string $pluralModelLabel = 'الطلبات';
    protected static ?string $navigationLabel = 'الطلبات';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('معلومات العميل'))
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__('الاسم'))
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('email')
                            ->label(__('البريد الإلكتروني'))
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('phone')
                            ->label(__('رقم الهاتف'))
                            ->required()
                            ->maxLength(20)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make(__('تفاصيل الطلب'))
                    ->schema([
                        Forms\Components\TextInput::make('code_vevication')
                            ->label(__('كود التحقق'))
                            ->required()
                            ->maxLength(50)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('subject')
                            ->label(__('الموضوع'))
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('message')
                            ->label(__('الرسالة'))
                            ->required()
                            ->columnSpanFull()
                            ->rows(3),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('الاسم'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label(__('البريد الإلكتروني'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label(__('الهاتف'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('code_vevication')
                    ->label(__('كود التحقق'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('subject')
                    ->label(__('الموضوع'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('message')
                    ->label(__('الرسالة'))
                    ->limit(30)
                    ->tooltip(function ($record) {
                        return $record->message;
                    })
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('تاريخ الطلب'))
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
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
                Tables\Actions\ViewAction::make()
                    ->tooltip(__('عرض')),

                Tables\Actions\EditAction::make()
                    ->tooltip(__('تعديل')),

                Tables\Actions\DeleteAction::make()
                    ->tooltip(__('حذف'))
                    ->modalHeading(__('تأكيد الحذف'))
                    ->modalDescription(__('هل أنت متأكد من رغبتك في حذف هذا الطلب؟'))
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
                    ->label(__('إضافة طلب جديد')),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
            'view' => Pages\viewOrder::route('/{record}'),

        ];
    }
    public static function infolist(Infolist $infolist): Infolist
    {

        return $infolist
            ->schema([
                infoListSectionOrder::make(fn(Order $record) => __('عرض رسالة من') . ' ' . $record->name)
                    ->description(fn(Order $record) => __('رسالة من') . ' ' . $record->name . ' ' . __('بتاريخ') . ' ' . $record->created_at->format('Y-m-d'))
                    ->schema([
                        TextEntry::make('name')
                            ->label(__('Name')),

                        TextEntry::make('email')
                            ->label(__('Email'))
                            ->url(fn(Order $record) => 'mailto:' . $record->email, true) // Redirect to email

                        ,

                        TextEntry::make('phone')
                            ->label(__('Phone'))
                            ->url(fn(Order $record) => 'tel:' . $record->phone, true), // Redirect to phone

                        TextEntry::make('message')
                            ->label(__('message')),

                        TextEntry::make('isReply')
                            ->label(__('isReply'))
                            ->formatStateUsing(fn(Order $record) => $record->isReply ? __('is replied') : __('not replied'))
                            ->color(fn(Order $record) => $record->isReply ? 'success' : 'danger')
                            ->badge(),

                        TextEntry::make('created_at')
                            ->label(__('Created At'))
                            ->dateTime()
                    ])->columns(2),

            ]);
    }
}
