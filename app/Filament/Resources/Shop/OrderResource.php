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
use Filament\Forms\Components\DatePicker;
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
use Filament\Tables\Filters\Filter;
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
                TextColumn::make('orderGroup.invoice_id')
                    ->label(_('Invoice'))
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('orderGroup.name')
                ->label(_('Creator Name'))
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('orderGroup.email')
                    ->label(__('Email'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('orderGroup.phone')
                    ->label(__('Phone'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
                    ->badge()
                    ->searchable()
                    ->toggleable(),
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
                TextColumn::make('orderGroup.deliveryDistrict.name')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('orderGroup.deliveryCity.name')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('orderGroup.delivery_address')
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
                Filter::make('price')
                    ->form([
                        TextInput::make('price_min')
                            ->numeric(),
                        TextInput::make('price_max')
                            ->numeric(),
                    ])
                    ->query(
                        function (Builder $query, array $data): Builder {
                            return $query
                                ->when($data['price_min'], fn (Builder $query, $price): Builder => $query->where('total_price', '>=', $price))
                                ->when($data['price_max'], fn (Builder $query, $price): Builder => $query->where('total_price', '<=', $price));
                        }
                    ),
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->groups([
                Tables\Grouping\Group::make('orderGroup.invoice_id')

                    ->collapsible(),
            ])->defaultGroup('orderGroup.invoice_id');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\OrderGroupRelationManager::class
        ];
    }

    public static function getWidgets(): array
    {
        return [
            OrderResource\Widgets\StatsOrdersOverview::class,
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
                    Select::make('shop_id')
                        ->relationship('shop', 'name')
                        ->disabled(),
                        ToggleButtons::make('status')
                            ->inline()
                            ->options(OrderStatus::class)
                            ->required()
                            ->columnSpanFull(),
                    TextInput::make('total_price')
                        ->numeric()
                        ->disabled(),
                        TextInput::make('delivery_charge')
                        ->numeric()
                        ->disabled(),
                        TextInput::make('coupon_id')
                        ->numeric()
                        ->disabled(),
                    Textarea::make('notes')
                        ->columnSpan('full'),
                ])
                ->columnSpanFull()

        ];
    }

    public static function getItemsRepeater(): Repeater
    {
        return Repeater::make('orderItems')
        ->disabled()
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
                            TextInput::make('price')
                            ->numeric()
                    ])
                    ->columns(3)
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
