<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TelegramGroupsModel;
use App\Models\CredentialsModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class APITelegramGroupsController extends Controller
{
    public function telegramGroups(Request $request)
    {
        $group_data = $request->all();
    
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
    
        $required_fields = ['group_id', 'group_name'];
        foreach ($required_fields as $field) {
            if (!isset($group_data[$field])) {
                return response()->json([
                    'code' => 400,
                    'status' => 'error',
                    'message' => "Missing parameter: $field"
                ]);
            }
        }
    
        if (!is_numeric($group_data['group_id']) || 
            ($group_data['group_owner'] !== null && $group_data['group_owner'] !== 'none' && !is_numeric($group_data['group_owner']))) {
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => 'Invalid data type for group_id or group_owner'
            ]);
        }    

        // Download profile picture jika tersedia
        $profile_picture_path = $group_data['group_profile_picture'] ?? null;
        if (!empty($group_data['group_profile_picture']) && filter_var($group_data['group_profile_picture'], FILTER_VALIDATE_URL)) {
            $image_url = $group_data['group_profile_picture'];
            $image_path = public_path("images/telegram/groups/{$group_data['group_id']}.jpg");
    
            try {
                $image_data = file_get_contents($image_url);
                if ($image_data !== false) {
                    file_put_contents($image_path, $image_data);
                    $profile_picture_path = "images/telegram/groups/{$group_data['group_id']}.jpg";
                }
            } catch (\Exception $e) {
                // Log error jika diperlukan
            }
        }
        
        $group = TelegramGroupsModel::where('group_id', $group_data['group_id'])->first();
    
        if ($group) {
            $group->update([
                'group_owner' => $group_data['group_owner'],
                'group_name' => $group_data['group_name'],
                'group_description' => $group_data['group_description'] ?? $group->group_description,
                'group_link' => $group_data['group_link'] ?? $group->group_link,
                'group_profile_picture' => $profile_picture_path ?? $group->group_profile_picture,
                'group_admin_count' => $group_data['group_admin_count'] ?? $group->group_admin_count,
                'group_member_count' => $group_data['group_member_count'] ?? $group->group_member_count,
                'group_member_block_count' => $group_data['group_member_block_count'] ?? $group->group_member_block_count,
                'group_chat_count' => $group_data['group_chat_count'] ?? $group->group_chat_count,
                'group_status' => $group_data['group_status'] ?? $group->group_status,
                'group_type' => $group_data['group_type'] ?? $group->group_type,
            ]);
    
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'group_id' => $group->group_id,
                'type' => 'update',
                'data' => $group,
            ]);
        }
    
        $new_group = TelegramGroupsModel::create([
            'group_id' => $group_data['group_id'],
            'group_owner' => $group_data['group_owner'],
            'group_name' => $group_data['group_name'],
            'group_description' => $group_data['group_description'] ?? null,
            'group_link' => $group_data['group_link'] ?? null,
            'group_profile_picture' => $profile_picture_path,
            'group_admin_count' => $group_data['group_admin_count'] ?? 0,
            'group_member_count' => $group_data['group_member_count'] ?? 0,
            'group_member_block_count' => $group_data['group_member_block_count'] ?? 0,
            'group_chat_count' => $group_data['group_chat_count'] ?? 0,
            'group_status' => $group_data['group_status'] ?? 'active',
            'group_type' => $group_data['group_type'] ?? 'private',
        ]);
    
        return response()->json([
            'code' => 200,
            'status' => 'success',
            'group_id' => $new_group->group_id,
            'type' => 'insert',
            'data' => $new_group
        ]);
    }
}
