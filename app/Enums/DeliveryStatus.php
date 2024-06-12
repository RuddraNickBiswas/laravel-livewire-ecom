<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum DeliveryStatus: string implements HasLabel, HasColor , HasIcon
{
    case Pending = 'pending';
    case Approve = 'approve';
    case Rejected = 'rejected';
    case Delivered = 'delivered';

    public function getLabel(): ?string
    {
        return match($this){
            self::Pending => "Pending",
            self::Approve => "Approve",
            self::Rejected => "Rejected",
            self::Delivered => "Delivered",
        };
    }


    public function getColor(): string|array|null
    {
        return match($this){
            self::Pending => "warning",
            self::Approve => "success",
            self::Rejected => "danger",
            self::Delivered => "info",
        };
    }



    public function getIcon(): ?string
    {
        return match($this){
            self::Pending => "heroicon-o-exclamation-circle",
            self::Approve => "heroicon-o-check-circle",
            self::Rejected => "heroicon-o-x-circle",
            self::Delivered => "heroicon-o-check-circle",
        };
    }
}





