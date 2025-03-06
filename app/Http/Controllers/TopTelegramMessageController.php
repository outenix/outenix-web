<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\TelegramMessagesModel;

class TopTelegramMessageController extends Controller
{
    public function topTelegramMessages()
    {
        // Pastikan pengguna sudah login
        if (Auth::check()) {
            // Ambil 20 pengguna dengan jumlah pesan terbanyak dan join dengan TelegramUsersModel
            $topMessages = TelegramMessagesModel::select(
                    'telegram_messages.user_id',
                    DB::raw('SUM(message_text) as total_message_text'),
                    DB::raw('SUM(message_photo) as total_message_photo'),
                    DB::raw('SUM(message_video) as total_message_video'),
                    DB::raw('SUM(message_sticker) as total_message_sticker'),
                    DB::raw('SUM(message_gif) as total_message_gif'),
                    DB::raw('SUM(message_other) as total_message_other'),
                    DB::raw('SUM(message_text + message_photo + message_video + message_sticker + message_gif + message_other) as message_count'),
                    DB::raw('COUNT(DISTINCT group_id) as group_count'),
                    'telegram_users.user_firstname',
                    'telegram_users.user_lastname',
                    'telegram_users.user_profile_picture',
                    'telegram_users.user_is_premium'
                )
                ->join('telegram_users', 'telegram_messages.user_id', '=', 'telegram_users.user_id')
                ->groupBy(
                    'telegram_messages.user_id', 
                    'telegram_users.user_firstname', 
                    'telegram_users.user_lastname', 
                    'telegram_users.user_profile_picture', 
                    'telegram_users.user_is_premium'
                )
                ->orderByDesc('message_count')
                ->limit(20)
                ->get();

            return $topMessages;
        }

        // Redirect ke halaman login jika belum login
        return redirect()->route('login');
    }
}
