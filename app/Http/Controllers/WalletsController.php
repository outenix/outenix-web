<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\WalletsModel;

class WalletsController extends Controller
{
    /**
     * Mengambil data wallet pengguna yang sedang login.
     *
     * @return mixed
     */
    public function wallets()
    {
        // Pastikan pengguna login
        if (Auth::check()) {
            $user = Auth::user();

            // Mengambil data wallet berdasarkan auth_id
            $wallet = WalletsModel::where('auth_id', $user->auth_id)->first();

            if ($wallet) {
                return $wallet;
            }
        }

        // Redirect ke halaman login jika data tidak tersedia
        return redirect()->route('login');
    }
}