<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use BezhanSalleh\FilamentShield\Support\Utils;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Filament\Models\Contracts\FilamentUser;
use FilamentShield;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    use HasRoles;
    // use HasPanelShield;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getRedirectRoute(): string
    {
        return match ((string)$this->role) {
            'user' => 'home',
            'admin' => 'admin.dashboard',
        };
    }

    protected static function booted(): void
    {
        if (config('filament-shield.shop_user.enabled', false)) {
            FilamentShield::createRole(name: config('filament-shield.shop_user.name', 'shop_user'));
            static::created(function (User $user) {
                $user->assignRole(config('filament-shield.shop_user.name', 'shop_user'));
            });
            static::deleting(function (User $user) {
                $user->removeRole(config('filament-shield.shop_user.name', 'shop_user'));
            });
        }
    }

    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        if($panel->getId() === 'admin'){
            return $this->hasRole(config('filament-shield.super_admin.name', 'super_admin')) || $this->hasRole('shop_user');
        }elseif($panel->getId() === 'shop'){
            return $this->hasRole(config('filament-shield.super_admin.name', 'super_admin')) || $this->hasRole(config('filament-shield.shop_user.name', 'shop_user'));
        }else{
            return false;
        }
    }
}
