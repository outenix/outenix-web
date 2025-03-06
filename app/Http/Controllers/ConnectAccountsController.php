<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\AuthsModel; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ConnectAccountsController extends Controller
{
    /**
     * Redirect ke halaman login Google.
     */
    public function redirectToGoogle(Request $request)
    {
        // Periksa apakah permintaan berasal dari AJAX
        if (!$request->ajax()) {
            // Jika bukan AJAX, redirect ke dashboard
            return redirect()->route('dashboard');
        }

        // URL callback
        $callbackUrl = 'http://127.0.0.1:8000/settings/redirect/google/callback';

        // Mengarahkan pengguna ke Google untuk autentikasi
        return response()->json([
            'status' => 'redirect',
            'url' => Socialite::driver('google')
                ->stateless()
                ->with(['redirect_uri' => $callbackUrl])
                ->redirect()
                ->getTargetUrl(),
        ]);
    }

    public function connectGoogle(Request $request)
    {
        try {
            // Periksa apakah pengguna sudah login
            if (!Auth::check()) {
                return redirect()->route('login');
            }

            // URL callback
            $callbackUrl = 'http://127.0.0.1:8000/settings/redirect/google/callback';
    
            // Mendapatkan informasi user dari Google
            $googleUser = Socialite::driver('google')
                ->stateless()
                ->redirectUrl($callbackUrl) // Pastikan redirect_uri disetel
                ->user();
    
            // Ambil ID dan email dari Google
            $googleId = $googleUser->id;
            $googleEmail = $googleUser->email;
    
            // Periksa apakah email sudah tertaut dengan Google
            $existingGoogleAccount = AuthsModel::where('email', $googleEmail)
                ->where('provider_name', 'google')
                ->first();
    
            if ($existingGoogleAccount) {
                return redirect()->route('settings/account')->with('warning', 'Email sudah tertaut, harap gunakan email lain.');
            }
    
            // Ambil email pengguna yang sedang login dari AuthsModel
            $authId = Auth::user()->auth_id; // Pastikan kolom `auth_id` ada di tabel pengguna
            $authModel = AuthsModel::where('auth_id', $authId)->first();
    
            if (!$authModel) {
                return redirect()->route('settings/account')->with('error', 'Data pengguna tidak ditemukan.');
            }
    
            $userEmail = $authModel->email;
    
            // Bandingkan email Google dengan email pengguna
            if ($googleEmail !== $userEmail) {
                return redirect()->route('settings/account')->with('warning', 'Email yang akan di tautkan tidak sama, harap gunakan email yang sesuai.');
            }
    
            // Jika email cocok, tambahkan Google ID ke provider_id
            $providerId = json_decode($authModel->provider_id, true) ?? []; // Decode kolom provider_id
            $providerId['google'] = $googleId; // Tambahkan provider "google" dan Google ID
            $authModel->provider_id = json_encode($providerId); // Encode kembali ke JSON
            $authModel->save(); // Simpan perubahan ke database
    
            return redirect()->route('settings/account')->with('success', 'Akun Google berhasil dihubungkan.');
        } catch (\Exception $e) {
            // Tangani error jika ada
            return redirect()->route('settings/account')->with('error', 'Terjadi kesalahan saat menghubungkan akun Google.');
        }
    }
}
