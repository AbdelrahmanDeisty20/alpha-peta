<?php

namespace App\Filament\Resources;


use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms;
use Filament\Infolists\Components\Section as InfolistSection;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;
    protected static ?string $navigationIcon = 'icon-contactus';
    protected static ?string $modelLabel = 'اتصال';
    protected static ?string $pluralModelLabel = 'اتصل بنا';
    protected static ?string $navigationLabel = 'اتصل بنا';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // تم تعطيل حقول الإدخال لأنها غير مطلوبة في هذه الحالة
                // يمكن تفعيلها لاحقاً إذا لزم الأمر
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('الاسم'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label(__('البريد الإلكتروني'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('message')
                    ->label(__('الرسالة'))
                    ->searchable()
                    ->limit(50)
                    ->tooltip(function ($record) {
                        return $record->message;
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('تاريخ الإرسال'))
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
                Tables\Actions\EditAction::make()
                    ->tooltip(__('تعديل')),

                Tables\Actions\DeleteAction::make()
                    ->tooltip(__('حذف'))
                    ->modalHeading(__('تأكيد الحذف'))
                    ->modalDescription(__('هل أنت متأكد من رغبتك في حذف هذا الاتصال؟'))
                    ->modalSubmitActionLabel(__('نعم، احذفه'))
                    ->modalCancelActionLabel(__('إلغاء')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label(__('حذف المحدد')),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function canCreate(): bool
    {
        return false; // تعطيل إنشاء اتصالات جديدة من لوحة التحكم
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
            'index' => Pages\ListContacts::route('/'),
            'view' => Pages\viewNoti::route('/{record}'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfolistSection::make(fn (Contact $record) => __('عرض رسالة من') . ' ' . $record->name)
                    ->description(fn (Contact $record) => __('رسالة من') . ' ' . $record->name . ' ' . __('بتاريخ') . ' ' . $record->created_at->format('Y-m-d'))
                    ->schema([
                        TextEntry::make('name')
                            ->label(__('Name')),

                        TextEntry::make('email')
                            ->label(__('Email'))
                            ->url(fn (Contact $record) => 'mailto:' . $record->email, true),

                        TextEntry::make('phone')
                            ->label(__('Phone'))
                            ->url(fn (Contact $record) => 'tel:' . $record->phone, true),

                        TextEntry::make('message')
                            ->label(__('Message')),

                        TextEntry::make('isReply')
                            ->label(__('Status'))
                            ->formatStateUsing(fn (Contact $record) => $record->isReply ? __('Replied') : __('Not Replied'))
                            ->color(fn (Contact $record) => $record->isReply ? 'success' : 'danger')
                            ->badge(),

                        TextEntry::make('created_at')
                            ->label(__('Created At'))
                            ->dateTime(),
                    ])
                    ->columns(2),
            ]);
    }
}
