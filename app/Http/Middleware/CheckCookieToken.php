<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\DevicesModel; // Import model DevicesModel
use App\Models\AuthsModel; // Import model AuthsModel
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie; // Import Cookie facade
use Carbon\Carbon; // Import Carbon untuk manipulasi tanggal

class CheckCookieToken
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
        // Ambil cookie_token dari permintaan
        $cookieToken = $request->cookie('cookie_token');

        // Jika cookie_token tidak ada
        if (!$cookieToken) {
            if (Auth::check()) {
                // Jika pengguna sedang login, lakukan logout
                $this->logout($request);
                return redirect()->route('loginView');
            }

            return $next($request); // Lanjutkan jika tidak ada cookie_token dan tidak login
        }

        // Jika cookie_token ada, cari di DevicesModel
        $device = DevicesModel::where('cookie_token', $cookieToken)->first();

        if (!$device) {
            // Jika device tidak ditemukan, logout
            $this->logout($request);
            return redirect()->route('loginView');
        }

        // Periksa apakah cookie_token telah kedaluwarsa
        $expiredAt = Carbon::parse($device->expired_at); // Ambil waktu expired_at dari device
        if ($expiredAt->isPast()) {
            // Jika sudah kedaluwarsa, logout dan redirect ke login
            $this->logout($request);
            return redirect()->route('loginView');
        }

        // Periksa apakah auth_id dari device ada di AuthsModel
        $authId = $device->auth_id;
        $user = AuthsModel::where('auth_id', $authId)->first();

        if (!$user) {
            // Jika auth_id tidak ditemukan di AuthsModel, logout
            $this->logout($request);
            return redirect()->route('loginView');
        }

        // Login pengguna menggunakan data dari AuthsModel
        Auth::login($user);

        // Lanjutkan request
        return $next($request);
    }

    /**
     * Logout pengguna dan hapus sesi serta cookie
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    protected function logout(Request $request)
    {
        Auth::logout(); // Logout pengguna
        Session::flush(); // Hapus semua data sesi

        // Hapus semua cookie
        foreach ($request->cookies as $key => $value) {
            Cookie::queue(Cookie::forget($key));
        }
    }
}
