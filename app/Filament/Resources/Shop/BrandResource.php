<?php

namespace App\Filament\Resources\Shop;

use App\Filament\Resources\Shop\BrandResource\Pages;
use App\Filament\Resources\BrandResource\RelationManagers;
use App\Filament\Resources\Shop\RelationManagers\ProductsRelationManager;
use App\Models\Shop\Brand;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Shop';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Grid::make()
                            ->schema([
                                FileUpload::make('thumbnail')
                                    ->disk('brands')
                                    ->imageEditor()
                                    ->imageCropAspectRatio('16:9')
                                    ->columnSpanFull(),
                            ])->columnSpan(1),
                        Grid::make()
                            ->schema([
                                TextInput::make('name')
                                    ->live(onBlur: true)
                                    ->required()->minLength(1)->maxLength(255)
                                    ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                        if ($operation === 'edit') {
                                            return;
                                        }
                                        $set('slug', \Str::slug($state));
                                    }),
                                TextInput::make('slug')->required()->unique(ignoreRecord: true),
                                Checkbox::make('is_active')
                            ])->columnSpan(4),
                    ])->columns(5),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')->disk('brands'),
                TextColumn::make('name')->searchable()->toggleable()->sortable(),
                CheckboxColumn::make('is_active')
                    ->label(__("Active"))
                    ->sortable()
                    ->toggleable(),

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
            ProductsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBrands::route('/'),
            'create' => Pages\CreateBrand::route('/create'),
            'edit' => Pages\EditBrand::route('/{record}/edit'),
        ];
    }
}
