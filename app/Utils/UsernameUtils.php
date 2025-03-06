<?php

namespace App\Utils;

class UsernameUtils
{
    /**
     * Membuat username acak dengan panjang 12 karakter.
     *
     * @return string
     */
    public static function generateRandomUsername(): string
    {
        // Karakter huruf pertama
        $letters = 'abcdefghijklmnopqrstuvwxyz';

        // Karakter tambahan yang diperbolehkan setelah 3 huruf pertama
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789._';

        // Panjang username yang diinginkan
        $length = 12;

        // Mengacak tiga karakter pertama sebagai huruf
        $username = '';
        for ($i = 0; $i < 3; $i++) {
            $username .= $letters[random_int(0, strlen($letters) - 1)];
        }

        // Mengacak sisa karakter
        for ($i = 3; $i < $length; $i++) {
            $username .= $characters[random_int(0, strlen($characters) - 1)];
        }

        return $username;
    }
}
