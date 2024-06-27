<?php

namespace App\Filament\Shop\Pages\Tenancy;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\EditTenantProfile;

class EditShopProfile extends EditTenantProfile
{
    public static function getLabel(): string
    {
        return 'Edit Shop Profile';
    }

    public function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('name'),
            TextInput::make('slug'),
        ]);
    }
}
