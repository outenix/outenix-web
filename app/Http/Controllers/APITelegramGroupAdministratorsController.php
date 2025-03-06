<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TelegramGroupAdministratorsModel;
use App\Models\CredentialsModel;
use Illuminate\Support\Facades\Log;

class APITelegramGroupAdministratorsController extends Controller
{
    public function telegramGroupAdministrators(Request $request)
    {
        $data = $request->all();

        $credentials = CredentialsModel::where('secret_id', $data['secret_id'] ?? null)
            ->where('secret_key', $data['secret_key'] ?? null)
            ->first();

        if (!$credentials) {
            return response()->json([
                'code' => 403,
                'status' => 'error',
                'message' => 'Invalid credentials'
            ]);
        }

        if (!isset($data['group_id']) || !isset($data['administrators']) || !is_array($data['administrators'])) {
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => 'Missing or invalid parameters'
            ]);
        }

        $group_id = $data['group_id'];
        $admins = $data['administrators'];
        
        foreach ($admins as $admin) {
            if (count($admin) < 7) {
                continue;
            }

            TelegramGroupAdministratorsModel::updateOrCreate(
                [
                    'group_id' => $admin[0],
                    'user_id' => $admin[1],
                ],
                [
                    'administrator_first_name' => $admin[2],
                    'administrator_last_name' => $admin[3],
                    'administrator_username' => $admin[4],
                    'administrator_type' => $admin[5],
                    'administrator_status' => $admin[6],
                ]
            );
        }

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Administrators updated successfully'
        ]);
    }
}
