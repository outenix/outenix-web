<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\DevicesModel;
use App\Utils\DeviceUtils;
use App\Utils\IpUtils;

class DevicesController extends Controller
{
    /**
     * Menampilkan daftar perangkat pengguna tanpa perangkat yang sesuai dengan kondisi di deviceLogin.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function devices(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $deviceData = DeviceUtils::parseDeviceInfo($request);
            $location = IpUtils::getLocationFromIP($request->ip());

            // Identifikasi perangkat yang sesuai
            $currentDevice = DevicesModel::where([
                'auth_id' => $user->auth_id,
                'device_name' => $deviceData['device_name'],
                'browser' => $deviceData['browser'],
                'device' => $deviceData['device'],
                'platform' => $deviceData['platform'],
                'ip_address' => $request->ip(),
                'location' => $location,
            ])->first();

            // Ambil semua perangkat
            $devices = DevicesModel::where('auth_id', $user->auth_id)
                ->orderBy('updated_at', 'desc')
                ->get();

            // Tambahkan perangkat yang sedang login di bagian atas daftar
            if ($currentDevice) {
                $devices = $devices->sortByDesc(function ($device) use ($currentDevice) {
                    return $device->id === $currentDevice->id ? 1 : 0;
                });
            }

            // Kirim data ke view
            return [
                'devices' => $devices,
                'currentDeviceId' => $currentDevice ? $currentDevice->id : null,
            ];
        }

        return redirect()->route('login');
    }
    
    /**
     * Menghapus cookie_token perangkat berdasarkan ID.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteDevice(Request $request)
    {
        // Pastikan hanya menerima POST request, jika tidak, beri abort 404
        if (!$request->isMethod('post')) {
            abort(404); // Jika bukan POST, arahkan ke halaman 404
        }

        // Periksa apakah pengguna sudah login
        if (!Auth::check()) {
            // Pengguna belum login, kembalikan JSON untuk mengarahkan ke login
            return response()->json(['status' => 'redirect', 'url' => '/login']);
        }

        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil token perangkat dari request
        $cookieToken = $request->input('cookie_token');

        if (!$cookieToken) {
            return response()->json(['status' => 'error', 'message' => 'Token perangkat tidak ditemukan.']);
        }

        // Cari perangkat berdasarkan cookie_token
        $device = DevicesModel::where('cookie_token', $cookieToken)->first();

        if ($device) {
            // Bandingkan id perangkat dengan auth_id pengguna
            if ($device->auth_id == $user->auth_id) {
                // Hapus perangkat dari database
                $device->delete();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Akun telah di keluarkan dan Perangkat berhasil dihapus.',
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan pada kecocokan perangkat.',
                ]);
            }
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Perangkat tidak ditemukan atau tidak dapat dihapus.',
        ]);
    }

    /**
     * Menghapus semua perangkat berdasarkan auth_id kecuali perangkat yang sedang login.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function clearDevices(Request $request)
    {
        // Pastikan hanya menerima POST request, jika tidak, beri abort 404
        if (!$request->isMethod('post')) {
            abort(404); // Jika bukan POST, arahkan ke halaman 404
        }
    
        // Periksa apakah pengguna sudah login
        if (!Auth::check()) {
            return response()->json(['status' => 'redirect', 'url' => '/login']);
        }
    
        // Ambil pengguna yang sedang login
        $user = Auth::user();
    
        // Ambil data perangkat yang sedang digunakan
        $deviceData = DeviceUtils::parseDeviceInfo($request);
        $location = IpUtils::getLocationFromIP($request->ip());
    
        $currentDevice = DevicesModel::where([
            'auth_id' => $user->auth_id,
            'device_name' => $deviceData['device_name'],
            'browser' => $deviceData['browser'],
            'device' => $deviceData['device'],
            'platform' => $deviceData['platform'],
            'ip_address' => $request->ip(),
            'location' => $location,
        ])->first();
    
        // Ambil semua perangkat berdasarkan auth_id kecuali perangkat yang sedang login
        $devicesToDelete = DevicesModel::where('auth_id', $user->auth_id)
            ->where('id', '!=', optional($currentDevice)->id) // Hindari error jika $currentDevice null
            ->get();
    
        // Jika tidak ada perangkat yang ditemukan untuk dihapus
        if ($devicesToDelete->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tidak ada perangkat lain yang tersedia untuk dihapus.',
            ]);
        }

        $totalDevices = DevicesModel::where('auth_id', $user->auth_id)->count();
        if ($totalDevices === 1) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tidak ada perangkat lain yang tersedia untuk dihapus.',
            ]);
        }
    
        // Hapus semua perangkat yang ditemukan
        foreach ($devicesToDelete as $device) {
            $device->delete();
        }
    
        return response()->json([
            'status' => 'success',
            'message' => 'Akun telah dihapus dari semua perangkat, dan semua perangkat telah dihapus.',
        ]);
    }    
}
