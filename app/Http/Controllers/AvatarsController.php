<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\AccountsModel;
use App\Models\AvatarsModel;

class AvatarsController extends Controller
{
    /**
     * Mengambil data avatar pengguna berdasarkan akun yang sedang login.
     *
     * @return mixed
     */
    public function avatar()
    {
        // Pastikan pengguna login
        if (Auth::check()) {
            $user = Auth::user();

            // Mengambil data akun berdasarkan auth_id
            $account = AccountsModel::where('auth_id', $user->auth_id)->first();

            if ($account) {
                // Mengambil data avatar berdasarkan profile_picture
                $avatar = AvatarsModel::where('avatar_code', $account->profile_picture)->first();

                if ($avatar) {
                    return $avatar;
                }
            }
        }

        // Redirect ke halaman login jika data tidak tersedia
        return redirect()->route('login');
    }

    public function avatars()
    {
        // Pastikan pengguna login
        if (Auth::check()) {
            // Mengambil semua data avatar dan mengecualikan avatar_pack = "Developer"
            $avatars = AvatarsModel::where('avatar_pack', '!=', 'Developer')->get()->groupBy('avatar_pack');
    
            if ($avatars) {
                return $avatars;
            }
        }
    
        // Redirect ke halaman login jika pengguna tidak login
        return redirect()->route('login');
    }   
}
