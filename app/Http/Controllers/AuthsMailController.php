<?php

namespace App\Http\Controllers;

use App\Utils\UsernameUtils;
use App\Utils\AuthUtils;
use App\Utils\DeviceUtils;
use App\Utils\IpUtils;
use App\Models\AuthsModel;
use App\Models\AvatarsModel;
use App\Models\AccountsModel;
use App\Models\WalletsModel;
use App\Models\DevicesModel;
use App\Models\LogAuthsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use Carbon\Carbon;

class AuthsMailController extends Controller
{
    // Halaman login untuk provider 'mail'
    public function loginView()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        if ($request->ajax()) {
            // Validasi untuk email
            $validatorEmail = Validator::make($request->all(), [
                'email' => [
                    'required',
                    'email',
                    'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
                ],
            ], [
                'email.required' => 'Email tidak boleh kosong',
                'email.email' => 'Format email tidak sesuai',
                'email.regex' => 'Format email tidak sesuai',
            ]);
    
            if ($validatorEmail->fails()) {
                return response()->json([
                    'status' => 'warning',
                    'message' => $validatorEmail->errors()->first('email'),
                ]);
            }
    
            // Validasi untuk password
            $validatorPassword = Validator::make($request->all(), [
                'password' => [
                    'required',
                ],
            ], [
                'password.required' => 'Kata sandi tidak boleh kosong',
            ]);
    
            if ($validatorPassword->fails()) {
                return response()->json([
                    'status' => 'warning',
                    'message' => $validatorPassword->errors()->first('password'),
                ]);
            }
    
            // Cek apakah email terdaftar
            $user = AuthsModel::where('email', $request->input('email'))->first();
            if (!$user) {
                return response()->json([
                    'status' => 'warning',
                    'message' => 'Email tidak terdaftar',
                ]);
            }
    
            // Cek apakah password benar
            if (!Hash::check($request->input('password'), $user->password)) {
                return response()->json([
                    'status' => 'warning',
                    'message' => 'Kata sandi tidak sesuai',
                ]);
            }
    
            // Cek status akun
            if ($user->status === 'suspend') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Akun anda telah di tangguhkan, hubungi pihak terkait',
                ]);
            }
    
            if ($user->status === 'banned') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Akun anda telah di banned, hubungi pihak terkait',
                ]);
            }
    
            if ($user->status === 'active') {
                Auth::login($user);

                // Menyimpan informasi perangkat dan log seperti biasa
                $deviceInfo = DeviceUtils::parseDeviceInfo($request);  
                $location = IpUtils::getLocationFromIP($request->ip());
    
                $cookieToken = Str::random(35);
                $expiredAt = now()->addDays(30);
    
                DevicesModel::updateOrCreate(
                    [
                        'auth_id' => $user->auth_id,
                        'device_name' => $deviceInfo['device_name'],
                        'browser' => $deviceInfo['browser'],
                        'device' => $deviceInfo['device'],
                        'platform' => $deviceInfo['platform'],
                        'ip_address' => $request->ip(),
                        'location' => $location,
                    ],
                    ['cookie_token' => $cookieToken, 'expired_at' => $expiredAt]
                );
    
                LogAuthsModel::create([
                    'auth_id' => $user->auth_id,
                    'device_name' => $deviceInfo['device_name'],
                    'browser' => $deviceInfo['browser'],
                    'device' => $deviceInfo['device'],
                    'platform' => $deviceInfo['platform'],
                    'ip_address' => $request->ip(),
                    'auth_at' => 'mail',
                    'location' => $location,
                ]);
    
                cookie()->queue(Cookie::forget('cookie_token'));
                cookie()->queue('cookie_token', $cookieToken, 43200);
    
                return response()->json([
                    'status' => 'success',
                    'message' => 'Selamat, Kamu telah berhasil masuk',
                    'redirect' => route('dashboard'),
                ]);
            }
    
            return response()->json([
                'status' => 'error',
                'message' => 'Status akun tidak sesuai, hubungi pihak terkait',
            ]);
        }
    
        return response()->json([
            'status' => 'error',
            'message' => 'Request tidak sesuai, hubungi pihak terkait',
        ]);
    }     

    // Halaman registrasi untuk provider 'mail'
    public function registerView()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        // Pengecekan apakah request menggunakan AJAX
        if ($request->ajax()) {
            // Validasi untuk name
            $validatorName = Validator::make($request->all(), [
                'name' => [
                    'required',
                    'string',
                    'min:5',
                    'regex:/^[a-zA-Z\s]+$/', // Hanya huruf dan spasi
                ],
            ], [
                'name.required' => 'Nama tidak boleh kosong',
                'name.min' => 'Minimal 5 karakter nama',
                'name.regex' => 'Format nama tidak sesuai',
            ]);
    
            if ($validatorName->fails()) {
                return response()->json([
                    'status' => 'warning',
                    'message' => $validatorName->errors()->first('name'),
                ]);
            }
    
            // Validasi untuk email
            $validatorEmail = Validator::make($request->all(), [
                'email' => [
                    'required',
                    'email',
                    'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
                ],
            ], [
                'email.required' => 'Email tidak boleh kosong',
                'email.email' => 'Format email tidak sesuai',
                'email.regex' => 'Format email tidak sesuai',
            ]);
    
            if ($validatorEmail->fails()) {
                return response()->json([
                    'status' => 'warning',
                    'message' => $validatorEmail->errors()->first('email'),
                ]);
            }
    
            // Validasi untuk password
            $validatorPassword = Validator::make($request->all(), [
                'password' => [
                    'required',
                    'min:8',
                    'confirmed',
                    'regex:/^[a-zA-Z0-9!@#$%^&*()_+={}\[\]:;\"\'<>?,.\/|-]+$/', // Hanya karakter yang diperbolehkan
                ],
            ], [
                'password.required' => 'Kata sandi tidak boleh kosong',
                'password.min' => 'Minimal 8 karakter kata sandi',
                'password.confirmed' => 'Konfirmasi kata sandi tidak sesuai',
                'password.regex' => 'Format kata sandi tidak sesuai',
            ]);
    
            if ($validatorPassword->fails()) {
                return response()->json([
                    'status' => 'warning',
                    'message' => $validatorPassword->errors()->first('password'),
                ]);
            }
    
            // Validasi untuk password_confirmation
            if ($request->input('password') !== $request->input('password_confirmation')) {
                return response()->json([
                    'status' => 'warning',
                    'message' => 'Konfirmasi kata sandi tidak sesuai',
                ]);
            }
    
            // Lanjutkan jika semua validasi berhasil
            $validated = $request->only(['name', 'email', 'password']);
    
            // Cek jika email sudah digunakan
            $emailExists = AuthsModel::where('email', $validated['email'])->exists();
            if ($emailExists) {
                return response()->json([
                    'status' => 'warning',
                    'message' => 'Email sudah terdaftar.',
                ]);
            }
    
            // Fungsi untuk menghasilkan auth_id unik
            $authId = AuthUtils::generateUniqueAuthId();
    
            // Membuat pengguna baru
            $user = AuthsModel::create([
                'auth_id' => $authId,
                'name' => $validated["name"],
                'email' => $validated["email"],
                'password' => Hash::make($validated["password"]),
                'provider_name' => 'mail',
                'provider_id' => json_encode(['mail' => $authId]),
                'ip_address' => $request->ip(),
                'status' => 'active',
            ]);

            // Membuat username random
            $username = UsernameUtils::generateRandomUsername();
            // Mengambil avatar secara acak dari AvatarsModel
            $avatar = AvatarsModel::inRandomOrder()->value('avatar_code');
            // Mendapatkan tanggal yang berjarak 13 tahun dari hari ini
            $birthday = Carbon::now()->subYears(13)->format('Y-m-d');

            // Contoh penggunaan di AccountsModel
            AccountsModel::create([
                'auth_id' => $authId,
                'username' => $username,
                'name' => $validated["name"],
                'phone' => null,
                'birthday' => $birthday,
                'gender' => 'male',
                'status' => 'member',
                'profile_picture' => $avatar,
            ]);
    
            // Membuat data wallet untuk pengguna
            WalletsModel::create([
                'auth_id' => $user->auth_id,
                'wallet_id' => '0x' . $authId,
                'balance' => 0,
            ]);
    
            $deviceData = DeviceUtils::parseDeviceInfo($request);  
            $location = IpUtils::getLocationFromIP($request->ip()); 
    
            // Generate cookie token dan masa berlaku
            $cookieToken = Str::random(35);
            $expiredAt = now()->addDays(30);
    
            // Menyimpan data perangkat
            DevicesModel::create(array_merge($deviceData, [
                'auth_id' => $user->auth_id,
                'ip_address' => $request->ip(),
                'location' => $location,
                'cookie_token' => $cookieToken,
                'expired_at' => $expiredAt,
            ]));
    
            // Menyimpan log autentikasi
            LogAuthsModel::create(array_merge($deviceData, [
                'auth_id' => $user->auth_id,
                'ip_address' => $request->ip(),
                'auth_at' => 'mail',
                'location' => $location,
            ]));
    
            cookie()->queue(Cookie::forget('cookie_token'));
            cookie()->queue('cookie_token', $cookieToken, 43200); // 43200 menit = 30 hari
    
            // Melakukan login setelah registrasi
            Auth::login($user);
    
            return response()->json([
                'status' => 'success',
                'message' => 'Selamat, Registrasi berhasil.',
                'redirect' => route('dashboard'),
            ]);
        }
    
        return response()->json([
            'status' => 'error',
            'message' => 'Request tidak sesuai, hubungi pihak terkait',
        ]);
    }    
}
