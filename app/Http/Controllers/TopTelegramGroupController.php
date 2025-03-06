<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\TelegramGroupsModel;

class TopTelegramGroupController extends Controller
{
    public function topTelegramGroups()
    {
        // Pastikan pengguna login
        if (Auth::check()) {

            // Ambil 20 grup dengan status 'active', diurutkan berdasarkan jumlah member + chat count
            $topGroups = TelegramGroupsModel::where('group_status', 'active')
                ->where('group_type', 'public')
                ->orderByRaw('group_member_count + group_chat_count DESC')
                ->limit(20)
                ->get();

            if ($topGroups) {
                return $topGroups;
            }
        }

        // Redirect ke halaman login jika data tidak tersedia
        return redirect()->route('login');
    }
}
