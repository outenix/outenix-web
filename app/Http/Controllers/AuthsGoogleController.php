<?php

namespace App\Http\Controllers;

use App\Utils\UsernameUtils;
use App\Utils\DeviceUtils;
use App\Utils\AuthUtils;
use App\Utils\IpUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use App\Models\AuthsModel;
use App\Models\AvatarsModel;
use App\Models\AccountsModel;
use App\Models\WalletsModel;
use App\Models\DevicesModel;
use App\Models\LogAuthsModel;
use Carbon\Carbon;

class AuthsGoogleController extends Controller
{
    public function redirectToGoogle()
    {
        // Set callback URL secara manual
        $callbackUrl = 'http://127.0.0.1:8000/auth/google/callback';
    
        return Socialite::driver('google')
            ->stateless()
            ->with(['redirect_uri' => $callbackUrl])
            ->redirect();
    }

    public function loginGoogle(Request $request)
    {
        try {
            $callbackUrl = 'http://127.0.0.1:8000/auth/google/callback';
            
            $googleUser = Socialite::driver('google')
                ->stateless()
                ->redirectUrl($callbackUrl) // Pastikan redirect_uri disetel
                ->user();

            $existingUser = AuthsModel::where('email', $googleUser->getEmail())->first();
            $deviceData = DeviceUtils::parseDeviceInfo($request);  // Panggil utilitas
            $location = IpUtils::getLocationFromIP($request->ip());  // Panggil utilitas
            $cookieToken = Str::random(35);
            $expiredAt = now()->addDays(30);
    
            if ($existingUser) {
                // Periksa status pengguna
                switch ($existingUser->status) {
                    case 'active':
                        break; // Lanjutkan
                    case 'banned':
                        echo '<script>
                            window.opener.postMessage({
                                status: "error",
                                message: "Akun anda telah di-banned, hubungi pihak terkait."
                            }, window.location.origin);
                            window.close();
                        </script>';
                        exit;
                    case 'suspend':
                        echo '<script>
                            window.opener.postMessage({
                                status: "error",
                                message: "Akun anda telah ditangguhkan, hubungi pihak terkait."
                            }, window.location.origin);
                            window.close();
                        </script>';
                        exit;
                    default:
                        echo '<script>
                            window.opener.postMessage({
                                status: "error",
                                message: "Status akun tidak valid."
                            }, window.location.origin);
                            window.close();
                        </script>';
                        exit;
                }
    
                // Jika status = Active, lanjutkan
                $providerIds = json_decode($existingUser->provider_id, true);
                if (isset($providerIds['google']) && $providerIds['google'] === $googleUser->getId()) {
                    $device = DevicesModel::where([
                        'auth_id' => $existingUser->auth_id,
                        'device_name' => $deviceData['device_name'],
                        'browser' => $deviceData['browser'],
                        'device' => $deviceData['device'],
                        'platform' => $deviceData['platform'],
                        'ip_address' => $request->ip(),
                        'location' => $location,
                    ])->first();
    
                    if ($device) {
                        $device->update([
                            'cookie_token' => $cookieToken,
                            'expired_at' => $expiredAt,
                            'updated_at' => now(),
                        ]);
                    } else {
                        DevicesModel::create(array_merge($deviceData, [
                            'auth_id' => $existingUser->auth_id,
                            'ip_address' => $request->ip(),
                            'location' => $location,
                            'cookie_token' => $cookieToken,
                            'expired_at' => $expiredAt,
                        ]));
                    }
    
                    LogAuthsModel::create(array_merge($deviceData, [
                        'auth_id' => $existingUser->auth_id,
                        'ip_address' => $request->ip(),
                        'auth_at' => 'google',
                        'location' => $location,
                    ]));
    
                    echo '<script>
                        window.opener.postMessage({
                            status: "success",
                            cookieToken: "' . $cookieToken . '"
                        }, window.location.origin);
                        window.close();
                    </script>';
                    exit;
                } else {
                    echo '<script>
                        window.opener.postMessage({
                            status: "warning",
                            message: "Email terdaftar tidak tertaut dengan Google."
                        }, window.location.origin);
                        window.close();
                    </script>';
                    exit;
                }
            }
    
            // Jika pengguna baru, lanjutkan proses pendaftaran
            $authId = AuthUtils::generateUniqueAuthId();
            $user = AuthsModel::create([
                'auth_id' => $authId,
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => Hash::make(Str::random(16)),
                'provider_name' => 'google',
                'provider_id' => json_encode(['google' => $googleUser->getId()]),
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
                'name' => $googleUser->getName(),
                'phone' => null,
                'birthday' => $birthday,
                'gender' => 'male',
                'status' => 'member',
                'profile_picture' => $avatar,
            ]);
    
            WalletsModel::create([
                'auth_id' => $user->auth_id,
                'wallet_id' => '0x' . $authId,
                'balance' => 0,
            ]);
    
            DevicesModel::create(array_merge($deviceData, [
                'auth_id' => $user->auth_id,
                'ip_address' => $request->ip(),
                'location' => $location,
                'cookie_token' => $cookieToken,
                'expired_at' => $expiredAt,
            ]));
    
            LogAuthsModel::create(array_merge($deviceData, [
                'auth_id' => $user->auth_id,
                'ip_address' => $request->ip(),
                'auth_at' => 'google',
                'location' => $location,
            ]));
    
            echo '<script>
                window.opener.postMessage({
                    status: "success",
                    cookieToken: "' . $cookieToken . '"
                }, window.location.origin);
                window.close();
            </script>';
            exit;
        } catch (\Exception $e) {
            echo '<script>
                window.opener.postMessage({
                    status: "error",
                    message: "Gagal login dengan Google, silakan coba lagi."
                }, window.location.origin);
                window.close();
            </script>';
            exit;
        }
    }     
    
    public function setAuthCookie(Request $request)
    {
        if ($request->isMethod('get')) {
            // Jika metode adalah GET, arahkan ke halaman 404
            abort(404); // Mengarah ke halaman 404 secara otomatis
        }
    
        if ($request->isMethod('post')) {
            $cookieToken = $request->input('cookieToken');
            if ($cookieToken) {
                $device = DevicesModel::where('cookie_token', $cookieToken)->first();
    
                if ($device) {
                    cookie()->queue('cookie_token', $cookieToken, 43200); // 30 hari
                    return response()->json(['status' => 'success', 'message' => 'Selamat, kamu masuk dengan Google', 'redirect' => route('dashboard')]);
                } else {
                    return response()->json(['status' => 'error', 'message' => 'Session tidak valid']);
                }
            }
            return response()->json(['status' => 'error', 'message' => 'Session tidak valid']);
        } else {
            return redirect()->route('error/404');
        }
    } 
}