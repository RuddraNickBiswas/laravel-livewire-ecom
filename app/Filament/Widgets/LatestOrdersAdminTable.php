<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Shop\OrderResource;
use App\Models\Shop\Order;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrdersAdminTable extends BaseWidget
{

    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(Order::query())
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('phone'),
                TextColumn::make('total_price'),
                TextColumn::make('status')
                    ->badge(),
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
            'edit' => route('filament.resources.posts.edit', $record), // Assuming 'posts' is the route name for editing posts
        ];
    }
}
