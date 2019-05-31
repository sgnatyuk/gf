<?php

namespace App\Helpers;

class Currency
{
    /**
     * Форматирование денежной суммы
     *
     * @param float|null $value
     * @param string $symbol
     * @return string|null
     */
    public static function format(?float $value, string $symbol = ' ₽'): ?string
    {
        if (!(int)$value) {
            return null;
        }

        // Французский формат (1 234,56)
        return '<span>' . number_format(round($value), 0, ',', ' ') . '</span>' . $symbol;
    }
}