<?php

namespace App\Filament\Shop\Pages\Tenancy;

use App\Models\Shop\Shop;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\RegisterTenant;

class RegisterShop extends RegisterTenant
{
    public static function getLabel(): string
    {
        return 'Register Shop';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                TextInput::make('slug'),
            ]);
    }

    protected function handleRegistration(array $data): Shop
    {
        $shop = Shop::create($data);

        $shop->members()->attach(auth()->user());

        return $shop;
    }
}
