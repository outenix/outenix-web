<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DevicesModel;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect ke login jika belum login
        }

        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Cek status pengguna (banned atau suspended)
        if (in_array($user->status, ['banned', 'buspended'])) {
            // Ambil semua ID perangkat berdasarkan auth_id
            $devices = DevicesModel::where('auth_id', $user->auth_id)->get();

            // Cek jumlah perangkat yang terkait dengan pengguna
            if ($devices->count() > 0) {
                // Hapus semua perangkat yang terkait dengan pengguna
                DevicesModel::where('auth_id', $user->auth_id)->delete();

                // Redirect ke login setelah menghapus perangkat
                return redirect()->route('login');
            }
        }

        // Jika status pengguna baik-baik saja, lanjutkan request ke rute berikutnya
        return $next($request);
    }
}
