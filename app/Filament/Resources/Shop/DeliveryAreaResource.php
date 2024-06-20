<?php

namespace App\Filament\Resources\Shop;

use App\Filament\Resources\Shop\DeliveryAreaResource\Pages;
use App\Filament\Resources\Shop\DeliveryAreaResource\RelationManagers;
use App\Models\Shop\DeliveryArea;
use App\Models\Shop\OrderDistrict;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DeliveryAreaResource extends Resource
{

    protected static ?string $model = OrderDistrict::class;

    protected static ?string $label = 'Delivery Area';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('District')
                    ->description('Delivery District')
                    ->schema([
                        TextInput::make('name'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('OrderCities.name')
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
            RelationManagers\OrderCitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDeliveryAreas::route('/'),
            'create' => Pages\CreateDeliveryArea::route('/create'),
            'edit' => Pages\EditDeliveryArea::route('/{record}/edit'),
        ];
    }
}
