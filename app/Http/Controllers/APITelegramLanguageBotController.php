<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TelegramLanguageBotModel;
use App\Models\CredentialsModel;

class APITelegramLanguageBotController extends Controller
{
    /**
     * Fungsi untuk menangani webhook pengguna dan mengecek apakah user_id sudah ada.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function telegramLanguageBot(Request $request)
    {
        // Ambil data pengguna dari request
        $user_data = $request->all();

        // Cek apakah secret_id dan secret_key tersedia di database
        $credentials = CredentialsModel::where('secret_id', $user_data['secret_id'] ?? null)
            ->where('secret_key', $user_data['secret_key'] ?? null)
            ->first();

        if (!$credentials) {
            return response()->json([
                'code' => 403,
                'status' => 'error',
                'message' => 'Invalid credentials'
            ]);
        }

        // Validasi bahwa semua parameter yang diperlukan tersedia
        if (!isset($user_data['user_id']) || !isset($user_data['bot_language_code'])) {
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => 'Missing required parameters'
            ]);
        }

        // Validasi format bot_language_code
        if (!preg_match('/^[a-z]{2}-[A-Z]{2}$/', $user_data['bot_language_code'])) {
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => 'Invalid format for bot_language_code'
            ]);
        }

        // Cek apakah user_id sudah ada di database
        $user = TelegramLanguageBotModel::where('user_id', $user_data['user_id'])->first();

        if ($user) {
            // Simpan status asli sebelum update
            $original_status = $user->user_status;

            // Update data pengguna
            $user->update([
                'bot_language_code' => $user_data['bot_language_code'],
            ]);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'user_id' => $user->user_id,
                'type' => 'update',
                'message' => 'User language updated successfully'
            ]);
        }

        // Masukkan data pengguna baru
        $new_user = TelegramLanguageBotModel::create([
            'user_id' => $user_data['user_id'],
            'bot_language_code' => $user_data['bot_language_code'],
        ]);

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'user_id' => $new_user->user_id,
            'type' => 'insert',
            'message' => 'New user added successfully'
        ]);
    }
}
