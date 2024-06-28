<?php

namespace App\Filament\Resources\Shop;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Filament\Resources\Shop\OrderGroupResource\Pages;
use App\Filament\Resources\Shop\OrderGroupResource\RelationManagers;
use App\Models\Shop\Order;
use App\Models\Shop\OrderCity;
use App\Models\Shop\OrderGroup;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class OrderGroupResource extends Resource
{
    protected static ?string $model = OrderGroup::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {

        return $form
        ->schema([
            Forms\Components\Group::make()
                ->schema([
                    Forms\Components\Section::make()
                        ->schema(static::getDetailsFormSchema())
                        ->columns(2),

                ])
                ->columnSpan(['lg' => fn (?OrderGroup $record) => $record === null ? 4 : 3]),

            Forms\Components\Section::make()
                ->schema([

                    Group::make()
                        ->schema([
                            Forms\Components\Placeholder::make('created_at')
                                ->label('Created at')
                                ->content(fn (OrderGroup $record): ?string => $record->created_at?->diffForHumans()),

                            Forms\Components\Placeholder::make('updated_at')
                                ->label('Last modified at')
                                ->content(fn (OrderGroup $record): ?string => $record->updated_at?->diffForHumans()),
                        ])
                ])
                ->columnSpan(['lg' => 1])
                ->hidden(fn (?OrderGroup $record) => $record === null),

        ])
        ->columns(4);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('invoice_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_price')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_delivery_charge')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deliveryDistrict.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deliveryCity.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('delivery_address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_status'),
                Tables\Columns\TextColumn::make('transaction_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('currency_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('payment_approve_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\OrdersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrderGroups::route('/'),
            'create' => Pages\CreateOrderGroup::route('/create'),
            'edit' => Pages\EditOrderGroup::route('/{record}/edit'),
        ];
    }





    /** @return Forms\Components\Component[] */
    public static function getDetailsFormSchema(): array
    {
        return [
            Group::make()
                ->schema([
                    TextInput::make('invoice_id')
                        ->default(generateInvoiceId())
                        ->disabled()
                        ->dehydrated()
                        ->required()
                        ->maxLength(32)
                        ->unique(OrderGroup::class, 'invoice_id', ignoreRecord: true),
                    Group::make()
                        ->schema([
                            TextInput::make('total_price')
                                ->required()
                                ->disabled()
                                ->dehydrated()
                                ->numeric(),
                            TextInput::make('total_delivery_charge')
                                ->required()
                                ->disabled()
                                ->dehydrated()
                                ->numeric(),

                        ])->columns()
                ])->columns(2)->columnSpanFull(),
            ToggleButtons::make('status')
                ->inline()
                ->options(OrderStatus::class)
                ->required()
                ->columnSpanFull(),
            Section::make('User Information')
                ->schema([

                    Forms\Components\Select::make('user_id')
                        ->relationship('user', 'name')
                        ->searchable()
                        ->required(),

                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('email')
                        ->email()
                        ->required()
                        ->maxLength(255),
                    TextInput::make('phone')
                        ->tel()
                        ->required(),
                ])->columns(2)->columnSpanFull(),
            Section::make('Delivery Area')
                ->schema([
                    Select::make('delivery_district_id')
                        ->relationship(name: 'deliveryDistrict', titleAttribute: 'name')
                        ->searchable()
                        ->preload()
                        ->live()
                        ->afterStateUpdated(function (Set $set) {
                            $set('delivery_city_id', null);
                        })
                        ->required(),
                    Select::make('delivery_city_id')
                        ->relationship(name: 'deliveryCity', titleAttribute: 'name')
                        ->options(fn (Get $get): Collection => OrderCity::query()
                            ->where('order_district_id', $get('delivery_district_id'))
                            ->pluck('name', 'id'))
                        ->searchable()
                        ->preload()
                        ->live()
                        ->afterStateUpdated(function ($state, Get $get, Set $set) {
                            $deliveryCharge = OrderCity::find($state)?->delivery_charge ?? 0;
                            $set('delivery_charge', $deliveryCharge);
                            self::updateTotalPrice($get, $set);
                        }),

                    TextInput::make('delivery_address')
                        ->required()
                        ->maxLength(255),
                ]),

            Section::make('Payment Status')
                ->schema([
                    ToggleButtons::make('payment_status')
                        ->inline()
                        ->options(PaymentStatus::class)
                        ->required()
                        ->columnSpanFull(),
                    TextInput::make('payment_method')
                        ->maxLength(255),
                    TextInput::make('payment_status')
                        ->maxLength(255)
                        ->default('incomplete'),
                    TextInput::make('transaction_id')
                        ->maxLength(255)
                        ->default(null),
                    TextInput::make('currency_code')
                        ->maxLength(255)
                        ->default(null),
                    DateTimePicker::make('payment_approve_date'),
                ])
                ->collapsible()
                ->collapsed(),


            Textarea::make('notes')
                ->columnSpan('full'),
        ];
    }

}
