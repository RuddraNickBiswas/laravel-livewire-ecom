<?php

namespace App\Filament\Resources\Shop\RelationManagers;

use CodeWithDennis\FilamentSelectTree\SelectTree;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('user_id')
                    ->default(auth()->id()),
                Section::make('Main')
                    ->description('Product')
                    ->schema([
                        TextInput::make('name')
                            ->live(onBlur: true)
                            ->required()
                            ->minLength(1)
                            ->maxLength(255)
                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                if ($operation === 'edit') {
                                    return;
                                }
                                $set('slug', \Str::slug($state));
                            }),
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),
                        TextInput::make('qty')
                            ->numeric()
                            ->required(),
                        TextInput::make('price')
                            ->numeric()
                            ->required(),
                        TextInput::make('discounted_price')
                            ->numeric(),
                        Textarea::make('description')
                            ->columnSpanFull(),
                        // Section::make('variants')
                        //     ->schema([
                        //         Repeater::make('variants')
                        //             ->relationship('variants')
                        //             ->schema([
                        //                 TextInput::make('name'),
                        //                 Repeater::make('attributes')
                        //                     ->relationship('attributes')
                        //                     ->schema([
                        //                         TextInput::make('name'),
                        //                         TextInput::make('price'),
                        //                     ])->grid(4)->maxItems(4)
                        //             ])
                        //     ])
                        //     ->collapsed()
                        //     ->collapsible()
                    ])
                    ->columnSpan(2)
                    ->columns(2),

                Section::make('meta')->schema([
                    FileUpload::make('thumbnail')
                        ->image()
                        ->imageEditor()
                        ->imageCropAspectRatio('16:9')
                        ->disk('products'),
                    SelectTree::make('categories')
                        ->dehydrated(false)
                        ->relationship('categories', 'name', 'parent_id'),
                    Checkbox::make('is_active'),
                ])->columnSpan(1),

            ])
            ->columns(3);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                ImageColumn::make('thumbnail')
                    ->disk('products'),
                TextColumn::make('name')
                    ->limit(50)
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('price')
                    ->numeric()
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('discounted_price')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('categories.name')
                    ->badge()
                    ->searchable()
                    ->toggleable(),
                CheckboxColumn::make('is_active')
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
