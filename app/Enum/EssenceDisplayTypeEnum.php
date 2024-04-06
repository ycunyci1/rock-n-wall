<?php

namespace App\Enum;

enum EssenceDisplayTypeEnum:string
{
    case DISPLAY_TYPE_HORIZONTAL = 'horizontal';
    case DISPLAY_TYPE_VERTICAL = 'vertical';

//    public static function toArray(): array
//    {
//        $data = [];
//        foreach (self::cases() as $case) {
//            $data[$case->name] = $case->value;
//        }
//
//        return $data;
//    }

}
