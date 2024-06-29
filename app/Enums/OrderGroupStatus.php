<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum OrderGroupStatus: string implements HasColor, HasIcon, HasLabel
{
    case New = 'new';

    case Verified = 'verified' ;

    case Cancelled = 'cancelled';
    case Refunded = 'refunded';

    public function getLabel(): string
    {
        return match ($this) {
            self::New => 'New',
            self::Verified => "Verified",
            self::Cancelled => 'Cancelled',
            self::Refunded => 'Refunded',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::New => 'info',
            self::Verified , self::Refunded => 'success',
            self::Cancelled => 'danger',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::New => 'heroicon-m-sparkles',
            self::Verified => "heroicon-m-check-badge",
            self::Cancelled => 'heroicon-m-x-circle',
            self::Refunded => 'heroicon-m-arrow-path',
        };
    }
}
