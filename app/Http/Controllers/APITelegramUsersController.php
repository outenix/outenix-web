<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TelegramUsersModel;
use App\Models\CredentialsModel;

class APITelegramUsersController extends Controller
{
    public function telegramUsers(Request $request)
    {
        $user_data = $request->all();
    
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
    
        $required_fields = ['user_id', 'user_firstname', 'user_is_premium'];
        foreach ($required_fields as $field) {
            if (!isset($user_data[$field])) {
                return response()->json([
                    'code' => 400,
                    'status' => 'error',
                    'message' => "Missing parameter: $field"
                ]);
            }
        }
    
        if (!is_numeric($user_data['user_id'])) {
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => 'Invalid data type for user_id'
            ]);
        }
    
        if (!is_string($user_data['user_firstname']) || !is_bool($user_data['user_is_premium'])) {
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => 'Invalid data type for user_firstname or user_is_premium'
            ]);
        }
    
        $user = TelegramUsersModel::where('user_id', $user_data['user_id'])->first();
    
        $profile_picture_path = $user->user_profile_picture ?? 'images/telegram/users/default.jpg';
        if (!empty($user_data['user_profile_picture']) && filter_var($user_data['user_profile_picture'], FILTER_VALIDATE_URL)) {
            $image_url = $user_data['user_profile_picture'];
            $image_path = public_path("images/telegram/users/{$user_data['user_id']}.jpg");
    
            try {
                $image_data = file_get_contents($image_url);
                if ($image_data !== false) {
                    file_put_contents($image_path, $image_data);
                    $profile_picture_path = "images/telegram/users/{$user_data['user_id']}.jpg";
                }
            } catch (\Exception $e) {
                // Log error jika diperlukan
            }
        }
    
        if ($user) {
            $user->update([
                'user_firstname' => $user_data['user_firstname'],
                'user_lastname' => $user_data['user_lastname'] ?? $user->user_lastname,
                'user_username' => $user_data['user_username'] ?? $user->user_username,
                'user_language_code' => $user_data['user_language_code'] ?? $user->user_language_code,
                'user_is_premium' => $user_data['user_is_premium'],
                'user_profile_picture' => $profile_picture_path,
            ]);
    
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'user_id' => $user->user_id,
                'type' => 'update',
                'data' => $user,
            ]);
        }
    
        $new_user = TelegramUsersModel::create([
            'user_id' => $user_data['user_id'],
            'user_firstname' => $user_data['user_firstname'],
            'user_lastname' => $user_data['user_lastname'] ?? null,
            'user_username' => $user_data['user_username'] ?? null,
            'user_language_code' => $user_data['user_language_code'] ?? null,
            'user_is_premium' => $user_data['user_is_premium'],
            'user_status' => 'active',
            'user_profile_picture' => $profile_picture_path,
        ]);
    
        return response()->json([
            'code' => 200,
            'status' => 'success',
            'user_id' => $new_user->user_id,
            'type' => 'insert',
            'data' => $new_user
        ]);
    }
}