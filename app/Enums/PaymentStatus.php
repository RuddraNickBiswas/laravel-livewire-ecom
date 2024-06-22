<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PaymentStatus: string implements HasColor, HasIcon, HasLabel
{
    case Incomplete = 'incomplete';

    case Completed = 'completed';

    case Verified = 'verified' ;

    case Failed = 'failed';

    case Refunded = 'refunded';


    public function getLabel():string
    {
        return match($this){
            self::Incomplete => "Incomplete",
            self::Completed => "Completed",
            self::Verified => "Verified",
            self::Failed => "Failed",
            self::Refunded => "Refunded",
        };
    }

    public function getColor(): array|string|null
    {
        return match($this){
            self::Incomplete => "warning",
            self::Completed => "info",
            self::Verified => "success",
            self::Failed => "danger",
            self::Refunded => "success",
        };
    }

    public function getIcon(): string|null
    {
        return match($this){
            self::Incomplete => "heroicon-m-exclamation-triangle",
            self::Completed => "heroicon-m-check-circle",
            self::Verified => "heroicon-m-check-badge",
            self::Failed => "heroicon-m-x-circle",
            self::Refunded => 'heroicon-m-arrow-path',
        };
    }

}
