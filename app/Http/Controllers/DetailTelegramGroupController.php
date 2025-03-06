<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\TelegramMessagesModel;
use App\Models\TelegramGroupsModel;
use Illuminate\Http\Request;

class DetailTelegramGroupController extends Controller
{
    // Ambil detail grup berdasarkan group_id
    public function getGroupDetails($group_id)
    {
        if (Auth::check()) {
            $groupDetails = TelegramGroupsModel::select(
                'group_id',
                'group_owner',
                'group_name',
                'group_description',
                'group_link',
                'group_profile_picture',
                'group_admin_count',
                'group_member_count',
                'group_member_block_count',
                'group_chat_count',
                'group_status'
            )
            ->where('group_id', $group_id) 
            ->first();

            return $groupDetails;
        }

        return redirect()->route('login');
    }

    // Ambil daftar pengguna teratas berdasarkan jumlah pesan dalam grup
    public function getTopUsers($group_id, $page, $sort = 'asc', $search = 'all')
    {
        if (Auth::check()) {
            // Ambil data grup
            $groupData = $this->getGroupDetails($group_id);

            $page = max(1, intval($page));
            $perPage = 30;
            $offset = ($page - 1) * $perPage;
            
            // Pastikan sort hanya berisi 'asc' atau 'desc'
            $sort = strtolower($sort) === 'asc' ? 'asc' : 'desc';

            // Ambil semua data pengguna tanpa filter untuk perhitungan rank
            $allUsers = TelegramMessagesModel::select(
                    'telegram_messages.user_id',
                    DB::raw('SUM(message_text + message_photo + message_video + message_sticker + message_gif + message_other) as message_count')
                )
                ->where('telegram_messages.group_id', $group_id)
                ->groupBy('telegram_messages.user_id')
                ->orderByDesc('message_count')
                ->get();

            // Tetapkan rank berdasarkan urutan `message_count`
            $rankedUsers = [];
            foreach ($allUsers as $index => $user) {
                $rankedUsers[$user->user_id] = $index + 1;
            }

            // Query untuk mengambil data yang akan ditampilkan
            $query = TelegramMessagesModel::select(
                    'telegram_messages.user_id',
                    'telegram_messages.message_text',
                    'telegram_messages.message_photo',
                    'telegram_messages.message_video',
                    'telegram_messages.message_sticker',
                    'telegram_messages.message_gif',
                    'telegram_messages.message_other',
                    'telegram_messages.last_message',
                    DB::raw('SUM(message_text + message_photo + message_video + message_sticker + message_gif + message_other) as message_count'),
                    'telegram_users.user_firstname',
                    'telegram_users.user_lastname',
                    'telegram_users.user_username', 
                    'telegram_users.user_is_premium',
                    'telegram_users.user_profile_picture'
                )
                ->join('telegram_users', 'telegram_messages.user_id', '=', 'telegram_users.user_id')
                ->where('telegram_messages.group_id', $group_id);

            // Jika $search tidak bernilai "all", lakukan pencarian
            if ($search !== 'all') {
                $query->where(function ($q) use ($search) {
                    $q->where('telegram_users.user_id', 'LIKE', "%{$search}%")
                    ->orWhere('telegram_users.user_firstname', 'LIKE', "%{$search}%")
                    ->orWhere('telegram_users.user_lastname', 'LIKE', "%{$search}%")
                    ->orWhere('telegram_users.user_username', 'LIKE', "%{$search}%"); // Menggunakan user_username dalam pencarian
                });
            }

            // Hitung total pengguna yang sesuai kriteria pencarian
            $totalUsers = $query->count(DB::raw('DISTINCT telegram_messages.user_id'));
            $totalPages = ceil($totalUsers / $perPage);

            // Ambil data pengguna dengan filter dan sorting
            $topUsers = $query->groupBy(
                    'telegram_messages.user_id',
                    'telegram_messages.message_text',
                    'telegram_messages.message_photo',
                    'telegram_messages.message_video',
                    'telegram_messages.message_sticker',
                    'telegram_messages.message_gif',
                    'telegram_messages.message_other',
                    'telegram_messages.last_message',
                    'telegram_users.user_firstname',
                    'telegram_users.user_lastname',
                    'telegram_users.user_username',
                    'telegram_users.user_is_premium',
                    'telegram_users.user_profile_picture'
                )
                ->orderByDesc('message_count') // Sorting tetap berdasarkan jumlah pesan
                ->get();

            // Tambahkan rank berdasarkan message_count seluruh data
            foreach ($topUsers as $user) {
                $user->rank = $rankedUsers[$user->user_id] ?? null; // Rank tetap mengikuti seluruh data
            }

            // Urutkan berdasarkan rank sesuai parameter sort
            $topUsers = $topUsers->sortBy('rank', SORT_REGULAR, $sort === 'desc')->slice($offset, $perPage)->values();

            // Tambahkan informasi tambahan
            foreach ($topUsers as $user) {
                $user->group_data = $groupData;
                $user->page = $page;
                $user->totalPages = $totalPages;
            }

            return $topUsers;
        }

        return redirect()->route('login');
    }
}