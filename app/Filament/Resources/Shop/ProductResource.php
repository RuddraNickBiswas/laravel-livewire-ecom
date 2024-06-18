<?php

namespace App\Filament\Resources\Shop;

use App\Filament\Resources\Shop\ProductResource\Pages;
use App\Filament\Resources\Shop\ProductResource\RelationManagers;
use App\Models\Category;
use App\Models\Shop\Product;
use CodeWithDennis\FilamentSelectTree\SelectTree;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Products')
                            ->schema([
                                Hidden::make('user_id')
                                    ->default(auth()->id()),
                                Group::make()
                                    ->schema([
                                        Section::make('General')
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
                                                    ->disabled()
                                                    ->dehydrated()
                                                    ->unique(Product::class, 'slug', ignoreRecord: true),

                                                Textarea::make('description')
                                                    ->columnSpanFull(),
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

                                    ])->columns(3),

                                Section::make('Pricing & Inventory')
                                    ->schema([
                                        TextInput::make('price')
                                            ->numeric()
                                            ->required(),
                                        TextInput::make('discounted_price')
                                            ->numeric(),
                                        TextInput::make('cost')
                                            ->label('Cost per item')
                                            ->helperText('Customers won\'t see this price.')
                                            ->numeric()
                                            ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/'])
                                            ->required(),
                                        TextInput::make('qty')
                                            ->numeric()
                                            ->required(),
                                        TextInput::make('sku')
                                            ->required()
                                            ->unique(Product::class, 'sku', ignoreRecord: true),
                                    ])->columns(3)
                            ]),


                        Tabs\Tab::make("Long Description")
                            ->schema([
                                Fieldset::make('LongDescription')
                                    ->relationship('longDescription')
                                    ->schema([
                                        RichEditor::make('description')
                                            ->columnSpanFull()
                                    ])
                            ]),

                        Tabs\Tab::make('SEO options')
                            ->schema([
                                TextInput::make('seo_title'),
                                TextArea::make('seo_description'),
                            ])

                    ])->columnSpanFull(),




            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
                    ->summarize(
                        Tables\Columns\Summarizers\Sum::make()
                            ->money(),
                    )
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
                TextColumn::make('created_at')
                    ->sortable()
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->sortable()
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('categories')
                    ->form([
                        SelectTree::make('categories')
                            ->relationship('categories', 'name', 'parent_id')
                            ->independent(false)
                            ->enableBranchNode()
                            ->searchable()
                            ->nullable(),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query->when($data['categories'], function ($query, $categories) {
                            return $query->whereHas('categories', fn ($query) => $query->whereIn('id', $categories));
                        });
                    })
                    ->indicateUsing(function (array $data): ?string {
                        if (!$data['categories']) {
                            return null;
                        }

                        return __('Categories') . ': ' . implode(', ', Category::whereIn('id', $data['categories'])->get()->pluck('name')->toArray());
                    }),


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
                Filter::make('price')
                    ->form([
                        TextInput::make('price_min')
                            ->numeric(),
                        TextInput::make('price_max')
                            ->numeric(),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['price_min'],
                                fn (Builder $query, $price): Builder => $query->where('price', '>=', $price),
                            )
                            ->when(
                                $data['price_max'],
                                fn (Builder $query, $price): Builder => $query->where('price', '<=', $price),
                            );
                    }),

                Filter::make('is_active')
                    ->toggle()
                    ->query(fn (Builder $query): Builder => $query->where('is_active', true)),



            ], )
            ->actions([

                \Filament\Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\RestoreAction::make(),
                    Tables\Actions\ForceDeleteAction::make(),
                    Tables\Actions\EditAction::make(),
                ])
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
            RelationManagers\VariantsRelationManager::class,
            RelationManagers\ImagesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
