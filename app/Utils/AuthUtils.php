<?php

namespace App\Utils;

use App\Models\AuthsModel;

class AuthUtils
{
    /**
     * Fungsi untuk menghasilkan auth_id unik.
     *
     * @return string
     */
    public static function generateUniqueAuthId(): string
    {
        do {
            $authId = rand(100000000000, 999999999999);  // Menghasilkan angka acak 12 digit
        } while (AuthsModel::where('auth_id', $authId)->exists());  // Cek apakah auth_id sudah ada

        return (string) $authId;  // Kembalikan auth_id yang unik
    }
}
