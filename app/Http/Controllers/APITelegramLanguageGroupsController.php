<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TelegramLanguageGroupModel;
use App\Models\CredentialsModel;

class APITelegramLanguageGroupsController extends Controller
{
    /**
     * Fungsi untuk menangani webhook grup dan mengecek apakah group_id sudah ada.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function telegramLanguageGroup(Request $request)
    {
        // Ambil data grup dari request
        $group_data = $request->all();

        // Cek apakah secret_id dan secret_key tersedia di database
        $credentials = CredentialsModel::where('secret_id', $group_data['secret_id'] ?? null)
            ->where('secret_key', $group_data['secret_key'] ?? null)
            ->first();

        if (!$credentials) {
            return response()->json([
                'code' => 403,
                'status' => 'error',
                'message' => 'Invalid credentials'
            ]);
        }

        // Validasi bahwa semua parameter yang diperlukan tersedia
        if (!isset($group_data['group_id']) || !isset($group_data['group_language_code'])) {
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => 'Missing required parameters'
            ]);
        }

        // Validasi format group_language_code
        if (!preg_match('/^[a-z]{2}-[A-Z]{2}$/', $group_data['group_language_code'])) {
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => 'Invalid format for group_language_code'
            ]);
        }

        // Cek apakah group_id sudah ada di database
        $group = TelegramLanguageGroupModel::where('group_id', $group_data['group_id'])->first();

        if ($group) {
            // Update data grup
            $group->update([
                'group_language_code' => $group_data['group_language_code'],
            ]);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'group_id' => $group->group_id,
                'type' => 'update',
                'message' => 'Group language updated successfully'
            ]);
        }

        // Masukkan data grup baru
        $new_group = TelegramLanguageGroupModel::create([
            'group_id' => $group_data['group_id'],
            'group_language_code' => $group_data['group_language_code'],
        ]);

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'group_id' => $new_group->group_id,
            'type' => 'insert',
            'message' => 'New group added successfully'
        ]);
    }
}
