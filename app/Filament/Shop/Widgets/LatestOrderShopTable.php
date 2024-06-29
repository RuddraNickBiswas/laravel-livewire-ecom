<?php

namespace App\Filament\Shop\Widgets;

use App\Filament\Shop\Resources\OrderResource;
use App\Models\Shop\Order;
use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestOrderShopTable extends BaseWidget
{

    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(Order::query()->whereBelongsTo(Filament::getTenant()))
            ->defaultSort('created_at', 'desc')
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
                    TextColumn::make('shop.name')
                    // ->label(_('Creator Name'))
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
                    ->label(__('Delivery District'))
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('orderGroup.deliveryCity.name')
                    ->label(__('Delivery City'))
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('orderGroup.delivery_address')
                    ->label(__('Delivery Address'))
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('payment_method')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('orderGroup.payment_status')
                    ->label(__('Payment Status'))
                    ->badge()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('orderGroup.transaction_id')
                    ->label(__('Transaction_id'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('orderGroup.currency_code')
                    ->label(__('Currency Code'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('orderGroup.payment_approve_date')
                    ->label(__('Payment Approve Date'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('coupon_id')
                    ->searchable()
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
                Tables\Actions\EditAction::make()->url(fn ($record) => OrderResource::getUrl('edit', ['record' => $record]))
                    ->openUrlInNewTab()
            ])
            ->paginated(5);
    }

    protected function getTableRowActions($record): array
    {
        return [
            // 'edit' =>  route('filament.resources.posts.edit', $record), // Assuming 'posts' is the route name for editing posts
            'edit' => OrderResource::getUrl('edit' ,$record)
        ];
    }
}
