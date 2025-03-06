<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\AccountsModel;
use App\Models\AuthsModel;
use Illuminate\Support\Facades\Log;

class ShareAccount
{
    /**
     * Menangani permintaan yang masuk.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Memeriksa apakah pengguna sudah login
        if (Auth::check()) {
            // Mendapatkan auth_id dari pengguna yang sedang login
            $authId = Auth::user()->auth_id;

            // Mengambil data akun berdasarkan 'auth_id'
            $accountData = AccountsModel::where('auth_id', $authId)->first();

            // Mengambil data tambahan dari AuthsModel berdasarkan 'auth_id'
            $authData = AuthsModel::where('auth_id', $authId)->first();

            // Gabungkan data ke dalam satu variabel
            if ($accountData || $authData) {
                $account = [
                    'account_data' => $accountData,
                    'auth_data'    => $authData,
                ];

                // Membagikan variabel ke semua tampilan
                view()->share('account', $account);
            }
        }

        return $next($request);
    }
}
