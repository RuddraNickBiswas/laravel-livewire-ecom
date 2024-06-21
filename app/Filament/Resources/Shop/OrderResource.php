<?php

namespace App\Filament\Resources\Shop;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Filament\Resources\Shop\OrderResource\Pages;
use App\Filament\Resources\Shop\OrderResource\RelationManagers;
use App\Models\Shop\Order;
use App\Models\Shop\Product;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Forms\Components\AddressForm;
use App\Models\Shop\OrderCity;
use App\Models\Shop\ProductVariant;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $recordTitleAttribute = 'invoice_id';


    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';


    protected static ?string $navigationGroup = 'Shop';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema(static::getDetailsFormSchema())
                            ->columns(2),

                        Forms\Components\Section::make('Order items')
                            ->headerActions([
                                Action::make('reset')
                                    ->modalHeading('Are you sure?')
                                    ->modalDescription('All existing items will be removed from the order.')
                                    ->requiresConfirmation()
                                    ->color('danger')
                                    ->action(fn (Forms\Set $set) => $set('orderItems', [])),
                            ])
                            ->schema([
                                static::getItemsRepeater(),
                            ]),
                    ])
                    ->columnSpan(['lg' => fn (?Order $record) => $record === null ? 4 : 3]),

                Forms\Components\Section::make()
                    ->schema([

                        Group::make()
                            ->schema([
                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Created at')
                                    ->content(fn (Order $record): ?string => $record->created_at?->diffForHumans()),

                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Last modified at')
                                    ->content(fn (Order $record): ?string => $record->updated_at?->diffForHumans()),
                            ])
                    ])
                    ->columnSpan(['lg' => 1])
                    ->hidden(fn (?Order $record) => $record === null),

            ])
            ->columns(4);
    }




    // Forms\Components\DateTimePicker::make('payment_approve_date'),
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('invoice_id')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('name')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('phone')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('owner.name')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
                TextColumn::make('total_price')
                    ->numeric()
                    ->sortable()
                    ->searchable()
                    ->summarize(
                        Tables\Columns\Summarizers\Sum::make()
                            ->money()
                    ),
                TextColumn::make('delivery_charge')
                    ->numeric()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('deliveryDistrict.name')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('deliveryCity.name')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('delivery_address')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('payment_method')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('payment_status')
                    ->badge()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('transaction_id')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('coupon_id')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('currency_code')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status'),
                TextColumn::make('payment_approve_date')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }


    /** @return Builder<Order> */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScope(SoftDeletingScope::class);
    }

    // public static function getGloballySearchableAttributes(): array
    // {
    //     return ['number', 'customer.name'];
    // }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Total Price' => $record->total_price,
            'Owner' => $record->owner->name,
        ];
    }

    /** @return Builder<Order> */
    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['orderItems']);
    }

    public static function getNavigationBadge(): ?string
    {
        /** @var class-string<Model> $modelClass */
        $modelClass = static::$model;

        return (string) $modelClass::where('status', 'new')->count();
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
                        ->unique(Order::class, 'invoice_id', ignoreRecord: true),
                    Group::make()
                        ->schema([
                            TextInput::make('total_price')
                                ->required()
                                ->disabled()
                                ->dehydrated()
                                ->numeric(),
                            TextInput::make('delivery_charge')
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
                        ->relationship('owner', 'name')
                        ->searchable()
                        ->required(),
                    // ->createOptionForm([
                    //     Forms\Components\TextInput::make('name')
                    //         ->required()
                    //         ->maxLength(255),

                    //     Forms\Components\TextInput::make('email')
                    //         ->label('Email address')
                    //         ->required()
                    //         ->email()
                    //         ->maxLength(255)
                    //         ->unique(),

                    //     Forms\Components\TextInput::make('phone')
                    //         ->maxLength(255),

                    // ])
                    // ->createOptionAction(function (Action $action) {
                    //     return $action
                    //         ->modalHeading('Create customer')
                    //         ->modalSubmitActionLabel('Create customer')
                    //         ->modalWidth('lg');
                    // }),


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
                    TextInput::make('coupon_id')
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

    public static function getItemsRepeater(): Repeater
    {
        return Repeater::make('orderItems')
            ->relationship()
            ->schema([
                Select::make('product_id')
                    ->label('Product')
                    ->options(Product::query()->pluck('name', 'id'))
                    ->required()
                    ->reactive()
                    ->live()
                    ->afterStateUpdated(function ($state, Get $get, Set $set) {
                        $set('unit_price', Product::find($state)?->price ?? 0);
                        self::updateTotalPrice($get, $set);
                    })
                    ->distinct()
                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                    ->columnSpan([
                        'md' => 5,
                    ])
                    ->searchable(),

                TextInput::make('qty')
                    ->label('Quantity')
                    ->numeric()
                    ->default(1)
                    ->live()

                    ->columnSpan([
                        'md' => 2,
                    ])
                    ->required(),

                TextInput::make('unit_price')
                    ->label('Unit Price')
                    ->disabled()
                    ->dehydrated()
                    ->numeric()
                    ->required()
                    ->columnSpan([
                        'md' => 3,
                    ]),
                Repeater::make('options')
                    ->schema([
                        Select::make('variant_name')
                            ->label('Variant')
                            ->options(function (Get $get, Set $set) {
                                $productId = $get('../../product_id');
                                return ProductVariant::where('product_id', $productId)->pluck('name', 'name');
                            })
                            ->afterStateUpdated(function ($state, Get $get, Set $set) {
                                $set('variant_attribute_name', null);
                            })
                            ->required()
                            ->reactive()
                            ->preload()
                            ->live()
                            ->searchable(),

                        Select::make('variant_attribute_name')
                            ->label('Variant Attribute')
                            ->options(function (Get $get) {
                                $variantName = $get('variant_name');
                                $productId = $get('../../product_id');
                                $variant = ProductVariant::where('product_id', $productId)->where('name', $variantName)->first();
                                if ($variant) {
                                    return $variant->attributes()->pluck('name', 'name');
                                }
                                return [];
                            })
                            ->required()
                            ->reactive()
                            ->preload()
                            ->live()
                            ->searchable(),
                    ])
                    ->columns(2)
                    ->columnSpanFull()
            ])
            ->live()
            ->afterStateUpdated(function (Get $get, Set $set) {
                self::updateTotalPrice($get, $set);
            })
            ->extraItemActions([
                Action::make('openProduct')
                    ->tooltip('Open product')
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->url(function (array $arguments, Repeater $component): ?string {
                        $itemData = $component->getRawItemState($arguments['item']);
                        $product = Product::find($itemData['product_id']);

                        if (!$product) {
                            return null;
                        }

                        return ProductResource::getUrl('edit', ['record' => $product]);
                    }, shouldOpenInNewTab: true)
                    ->hidden(fn (array $arguments, Repeater $component): bool => blank($component->getRawItemState($arguments['item'])['product_id'])),
            ])
            // ->orderColumn('sort')
            ->defaultItems(1)
            ->hiddenLabel()
            ->columns([
                'md' => 10,
            ]);
    }

    protected static function updateTotalPrice(Get $get, Set $set): void
    {

        $orderItems = $get('orderItems') ?? [];
        $deliveryCharge = $get('delivery_charge') ?? 0;
        //  dd($get('orderItems'));
        $orderItemsTotal = collect($orderItems)->reduce(function ($total, $item) {
            return $total + ($item['unit_price'] * $item['qty']);
        }, 0);

        $set('total_price', $orderItemsTotal + $deliveryCharge);
    }
}
