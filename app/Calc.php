<?php

namespace App;

class Calc {
    public static function element_moyenne(int $controle,int $exam)
    {
        return round(($controle * 0.4) + ($exam * 0.6), 2);
    }

    public static function module_moyenne($elements)
    {
        $some = 0;
        foreach ($elements as $element) {
            $some += static::element_moyenne($element['controle'], $element['exam']);
        }

        return round($some / $elements->count(), 2);
    }
}