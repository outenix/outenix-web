<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TelegramMessagesModel;
use App\Models\TelegramUsersModel;
use App\Models\CredentialsModel;
use Carbon\Carbon;

class APITelegramMessagesController extends Controller
{
    public function telegramMessages(Request $request)
    {
        // Validasi kredensial
        $credentials = CredentialsModel::where('secret_id', $request->input('secret_id'))
            ->where('secret_key', $request->input('secret_key'))
            ->first();

        if (!$credentials) {
            return response()->json([
                'code' => 403,
                'status' => 'error',
                'message' => 'Invalid credentials'
            ]);
        }

        $messages = $request->input('data', []);
        if (empty($messages)) {
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => 'Missing or invalid data',
                'data' => $request->all()
            ]);
        }

        $today = Carbon::today();

        foreach ($messages as $message) {
            if (!isset($message['group_id'], $message['user_id'], $message['first_name'])) {
                continue;
            }

            $name = trim(($message['first_name'] ?? '') . ' ' . ($message['last_name'] ?? ''));
            $lastMessage = $message['last_message'] ?? '';

            // Cek apakah sudah ada data untuk hari ini berdasarkan group_id dan user_id
            $existingMessage = TelegramMessagesModel::where('group_id', $message['group_id'])
                ->where('user_id', $message['user_id'])
                ->whereDate('created_at', $today)
                ->first();

            if ($existingMessage) {
                // Update data jika sudah ada untuk hari ini
                $existingMessage->update([
                    'message_text'    => $existingMessage->message_text + ($message['message_text'] ?? 0),
                    'message_photo'   => $existingMessage->message_photo + ($message['message_photo'] ?? 0),
                    'message_video'   => $existingMessage->message_video + ($message['message_video'] ?? 0),
                    'message_sticker' => $existingMessage->message_sticker + ($message['message_sticker'] ?? 0),
                    'message_gif'     => $existingMessage->message_gif + ($message['message_gif'] ?? 0),
                    'message_other'   => $existingMessage->message_other + ($message['message_other'] ?? 0),
                    'name'            => $name,
                    'last_message'    => $lastMessage,
                    'updated_at'      => Carbon::now()
                ]);
            } else {
                // Insert data baru jika belum ada untuk hari ini
                TelegramMessagesModel::create([
                    'group_id'       => $message['group_id'],
                    'user_id'        => $message['user_id'],
                    'name'           => $name,
                    'last_message'   => $lastMessage,
                    'message_text'   => $message['message_text'] ?? 0,
                    'message_photo'  => $message['message_photo'] ?? 0,
                    'message_video'  => $message['message_video'] ?? 0,
                    'message_sticker'=> $message['message_sticker'] ?? 0,
                    'message_gif'    => $message['message_gif'] ?? 0,
                    'message_other'  => $message['message_other'] ?? 0,
                    'created_at'     => Carbon::now(),
                    'updated_at'     => Carbon::now()
                ]);
            }

            // Data untuk tabel TelegramUsersModel
            $isPremium = isset($message['is_premium']) && $message['is_premium'] ? 1 : 0;

            $existingUser = TelegramUsersModel::where('user_id', $message['user_id'])->first();
            if ($existingUser) {
                $existingUser->update([
                    'user_firstname'     => $message['first_name'] ?? '',
                    'user_lastname'      => $message['last_name'] ?? null,
                    'user_username'      => $message['username'] ?? '',
                    'user_language_code' => $message['language_code'] ?? 'en-EN',
                    'user_is_premium'    => $isPremium,
                    'updated_at'         => Carbon::now(),
                ]);
            } else {
                TelegramUsersModel::create([
                    'user_id'            => $message['user_id'],
                    'user_firstname'     => $message['first_name'] ?? '',
                    'user_lastname'      => $message['last_name'] ?? null,
                    'user_username'      => $message['username'] ?? '',
                    'user_language_code' => $message['language_code'] ?? 'en-EN',
                    'user_is_premium'    => $isPremium,
                    'user_status'        => 'active',
                    'user_profile_picture'=> 'images/telegram/users/default.jpg',
                    'updated_at'         => Carbon::now(),
                ]);
            }
        }

        return response()->json([
            'code'    => 200,
            'status'  => 'success',
            'message' => 'Messages and users processed successfully'
        ]);
    }
}
