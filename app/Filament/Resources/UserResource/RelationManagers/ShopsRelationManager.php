<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Models\Shop\Shop;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ShopsRelationManager extends RelationManager
{
    protected static string $relationship = 'Shops';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->live(onBlur: true)
                            ->required()
                            ->maxLength(255)
                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set){
                                if ($operation === 'edit') {
                                    return;
                                }
                                $set('slug', \Str::slug($state));
                            })
                        ,

                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->disabled()
                            ->dehydrated()
                            ->unique(Shop::class, 'slug', ignoreRecord: true ),
                    ])->columnSpanFull()
                ->columns(2),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
//                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
