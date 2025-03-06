<?php

namespace App\Utils;

class NumberUtils
{
    /**
     * Format number to display shorthand notation (e.g., 100JT for 100 million).
     *
     * @param int|float $number
     * @return string
     */
    public static function formatToIndonesianShort($number): string
    {
        if ($number >= 1000000000) {
            return round($number / 1000000000, 1) . 'M'; // Miliar
        }
        if ($number >= 100000000) {
            return round($number / 1000000) . 'JT'; // Juta
        }
        if ($number >= 1000000) {
            return round($number / 1000000, 1) . 'JT';
        }
        if ($number >= 1000) {
            return round($number / 1000, 1) . 'RB';
        }

        return (string) $number;
    }
}
