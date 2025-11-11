<?php

namespace App\Enums;

enum ProjectStatus: string
{
    case OPEN = 'open';
    case CLOSED = 'closed';

    public function label(): string
    {
        return match ($this) {
            self::OPEN => 'Aberto',
            self::CLOSED => 'Fechado',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::OPEN => 'green',
            self::CLOSED => 'gray',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

