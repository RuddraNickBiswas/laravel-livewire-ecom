<?php

namespace App\Filament\Resources\Shop;

use App\Filament\Resources\Shop\CategoryResource\Pages;
use App\Filament\Resources\Shop\CategoryResource\RelationManagers;
use App\Filament\Resources\Shop\RelationManagers\ProductsRelationManager;
use App\Models\Shop\Category;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-bookmark';


    protected static ?string $navigationGroup = 'Shop';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')
                    ->schema([
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
                            ]),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('slug')->sortable()->searchable()->toggleable(),
                TextColumn::make('parent.name')->sortable()->toggleable(),
                TextColumn::make('children.name')->toggleable(isToggledHiddenByDefault:true),
                CheckboxColumn::make('is_active')->sortable(),
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
            RelationManagers\SubCategoriesRelationManager::class,
            ProductsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
