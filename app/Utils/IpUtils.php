<?php

namespace App\Utils;

class IpUtils
{
    /**
     * Mendapatkan lokasi berdasarkan alamat IP.
     *
     * @param string $ip
     * @return string
     */
    public static function getLocationFromIP(string $ip): string
    {
        $locationData = @file_get_contents("http://ip-api.com/json/{$ip}");
        $locationData = $locationData ? json_decode($locationData, true) : null;

        if ($locationData && $locationData['status'] === 'success') {
            return "{$locationData['city']}, {$locationData['country']}";
        }

        return 'Unknown';
    }
}
