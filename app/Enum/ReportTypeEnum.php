<?php

namespace App\Enum;

enum ReportTypeEnum: string
{
    case FOUND_BUG = 'found_bug';
    case RIGHTS = 'rights';
    case OTHER = 'other';

    public static function values(): array
    {
        $values = [];
        foreach (self::cases() as $case) {
            $values[] = $case->value;
        }
        return $values;
    }
}
