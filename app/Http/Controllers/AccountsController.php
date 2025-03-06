<?php

namespace App\Http\Controllers;


use App\Models\AccountsModel;
use App\Models\LogAccountsModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;    
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;

class AccountsController extends Controller
{
    /**
     * Mengambil data akun dan avatar pengguna yang sedang login.
     *
     * @return mixed
     */
    public function account()
    {
        // Pastikan pengguna login
        if (Auth::check()) {
            $user = Auth::user();

            // Mengambil data akun berdasarkan auth_id
            $account = AccountsModel::where('auth_id', $user->auth_id)->first();

            if ($account) {
                return $account;
            }
        }

        // Redirect ke halaman login jika data tidak tersedia
        return redirect()->route('login');
    }

    /**
     * Mengedit data akun pengguna berdasarkan auth_id.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function editAccount(Request $request)
    {
        // Periksa apakah permintaan berasal dari AJAX
        if (!$request->ajax()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Permintaan tidak sesuai',
            ]);
        }

        // Periksa autentikasi pengguna
        if (!auth()->check()) {
            return response()->json([
                'status' => 'redirect',
                'url' => '/login',
            ]);
        }

        // Ambil auth_id dari pengguna yang sedang login
        $authId = auth()->user()->auth_id;

        // Ambil input dari request dan pastikan usernameAccount menggunakan huruf kecil
        $usernameAccount = strtolower($request->input('usernameAccount'));
        $nameAccount = $request->input('nameAccount');
        $phoneAccount = $request->input('phoneAccount');
        $genderAccount = $request->input('genderAccount');
        $birthdayAccount = $request->input('birthdayAccount');

        // Validasi usernameAccount
        if (is_null($usernameAccount)) {
            return response()->json([
                'status' => 'warning',
                'message' => 'Username tidak boleh kosong',
            ]);
        }

        // Validasi nameAccount
        if (is_null($nameAccount)) {
            return response()->json([
                'status' => 'warning',
                'message' => 'Nama tidak boleh kosong',
            ]);
        }

        // Validasi genderAccount
        $allowedGenders = ['male', 'female', 'other'];
        if (!in_array($genderAccount, $allowedGenders)) {
            return response()->json([
                'status' => 'warning',
                'message' => 'Gender tidak sesuai dan tidak ada',
            ]);
        }

        // Validasi birthdayAccount
        if (!strtotime($birthdayAccount)) {
            return response()->json([
                'status' => 'warning',
                'message' => 'Format tanggal lahir tidak sesuai',
            ]);
        }

        // Cek apakah usia pengguna lebih dari 13 tahun
        $birthday = new \DateTime($birthdayAccount);
        $today = new \DateTime();
        $age = $today->diff($birthday)->y; // Menghitung usia dalam tahun

        if ($age < 13) {
            return response()->json([
                'status' => 'warning',
                'message' => 'Kamu harus berumur setidaknya 13+',
            ]);
        }

        // Temukan akun berdasarkan auth_id
        $account = AccountsModel::where('auth_id', $authId)->first();

        if (!$account) {
            return response()->json([
                'status' => 'error',
                'message' => 'Akun tidak ditemukan',
            ]);
        }

        // Format tanggal input dan tanggal di database menjadi hanya tanggal (tanpa waktu)
        $formattedBirthdayAccount = Carbon::parse($birthdayAccount)->format('Y-m-d');
        $formattedBirthdayDatabase = Carbon::parse($account->birthday)->format('Y-m-d');

        // Periksa apakah data yang dimasukkan sudah sama dengan yang ada di database
        if (
            $account->username === $usernameAccount &&
            $account->name === $nameAccount &&
            $account->phone === $phoneAccount &&
            $account->gender === $genderAccount &&
            $formattedBirthdayDatabase === $formattedBirthdayAccount
        ) {
            return response()->json([
                'status' => 'warning',
                'message' => 'Tidak ada perubahan pada akun',
            ]);
        }

        // Periksa apakah data yang dimasukkan sudah sama dengan yang ada di database
        $isDataSame = true;
        if ($account->username !== $usernameAccount) {
            $isDataSame = false;
        }
        if ($account->name !== $nameAccount) {
            $isDataSame = false;
        }
        if ($account->phone !== $phoneAccount) {
            $isDataSame = false;
        }
        if ($account->gender !== $genderAccount) { 
            $isDataSame = false;
        }
        if ($formattedBirthdayDatabase !== $formattedBirthdayAccount) {
            $isDataSame = false;
        }

        // Jika semua data sama, tidak perlu ada perubahan
        if ($isDataSame) {
            return response()->json([
                'status' => 'warning',
                'message' => 'Tidak ada perubahan pada akun',
            ]);
        }

        // Cek apakah usernameAccount sudah terdaftar di database
        if ($isDataSame && AccountsModel::where('username', $usernameAccount)->exists()) {
            return response()->json([
                'status' => 'warning',
                'message' => 'Username tidak dapat digunakan',
            ]);
        }

        // Cek apakah phoneAccount sudah terdaftar di database
        if ($isDataSame && AccountsModel::where('phone', $phoneAccount)->exists()) {
            return response()->json([
                'status' => 'warning',
                'message' => 'Nomor telepon tidak dapat di gunakan',
            ]);
        }

        // Validasi usernameAccount
        $validatorUsername = Validator::make($request->only('usernameAccount'), [
            'usernameAccount' => [
                'required',
                'string',
                'min:8', // Minimal 8 karakter
                'max:15',
                'regex:/^[a-zA-Z]{3}[a-zA-Z0-9._]*$/', // Tiga karakter awal harus huruf, sisanya huruf, angka, titik, atau garis bawah
            ],
        ], [
            'usernameAccount.required' => 'Username tidak boleh kosong',
            'usernameAccount.min' => 'Username minimal 8 karakter',
            'usernameAccount.max' => 'Maksimal 15 karakter username',
            'usernameAccount.regex' => 'Format username tidak sesuai, harap gunakan 3 huruf di awal username, Hanya huruf, angka, dan tanda . / _ yang diperbolehkan untuk karakter lainnya.',
        ]);

        if ($validatorUsername->fails()) {
            return response()->json([
                'status' => 'warning',
                'message' => $validatorUsername->errors()->first('usernameAccount'),
            ]);
        }

        // Validasi nameAccount
        $validatorName = Validator::make($request->only('nameAccount'), [
            'nameAccount' => [
                'required',
                'string',
                'min:5',
                'regex:/^[a-zA-Z\s]+$/', // Hanya huruf dan spasi
            ],
        ], [
            'nameAccount.required' => 'Nama tidak boleh kosong',
            'nameAccount.min' => 'Minimal 5 karakter nama',
            'nameAccount.regex' => 'Format nama tidak sesuai',
        ]);

        if ($validatorName->fails()) {
            return response()->json([
                'status' => 'warning',
                'message' => $validatorName->errors()->first('nameAccount'),
            ]);
        }

        // Validasi phoneAccount
        if ($phoneAccount) {
            $validatorPhone = Validator::make($request->only('phoneAccount'), [
                'phoneAccount' => [
                    'required',
                    'string',
                    'regex:/^(?:\+62|62|0)\d{8,}$/', // +62, 62, atau 0 diikuti minimal 8 digit angka
                ],
            ], [
                'phoneAccount.required' => 'Nomor telepon tidak boleh kosong',
                'phoneAccount.regex' => 'Nomor telepon harus diawali dengan +62, 62, atau 0 dan minimal 8 digit setelahnya',
            ]);

            if ($validatorPhone->fails()) {
                return response()->json([
                    'status' => 'warning',
                    'message' => $validatorPhone->errors()->first('phoneAccount'),
                ]);
            }
        }
        
        // Periksa apakah ada lebih dari 3 perubahan username dalam waktu 7 hari
        $changesInLastWeek = LogAccountsModel::where('auth_id', $authId)
            ->where('column_changed', 'username')
            ->where('updated_at', '>=', Carbon::now()->subDays(7)) // Waktu perubahan dalam 7 hari terakhir
            ->count();

            if ($account->username !== $usernameAccount && $changesInLastWeek >= 3) { // Perubahan username >= 3
            return response()->json([
                'status' => 'warning',
                'message' => 'Kamu hanya dapat merubah username sebanyak 3 kali dalam waktu 7 hari',
            ]);
        }

        // Periksa apakah ada lebih dari 10 perubahan dalam waktu 24 jam
        $changesInLast24Hours = LogAccountsModel::where('auth_id', $authId)
        ->where('updated_at', '>=', Carbon::now()->subHours(24)) // Waktu perubahan dalam 24 jam terakhir
        ->count();

        if (
            (
            $account->name !== $nameAccount || 
            $account->phone !== $phoneAccount || 
            $account->gender !== $genderAccount || 
            $account->birthday !== $birthdayAccount
            ) && 
            $changesInLast24Hours >= 10 // Perubahan data >= 10 dalam 24 jam
            ) {
            return response()->json([
                'status' => 'warning',
                'message' => 'Terlalu banyak memperbaharui data, coba lagi dalam 24 jam',
            ]);
        }

        // Update hanya kolom yang diisi dan valid
        $updatedFields = [];
        if ($account->username !== $usernameAccount) {
            $account->username = $usernameAccount;
            $updatedFields[] = 'Username';
        }
        if ($account->name !== $nameAccount) {
            $account->name = $nameAccount;
            $updatedFields[] = 'Nama Lengkap';
        }
        if ($account->phone !== $phoneAccount) {
            $account->phone = $phoneAccount;
            $updatedFields[] = 'Nomor Telepon';
        }
        if ($account->gender !== $genderAccount) { 
            $account->gender = $genderAccount;
            $updatedFields[] = 'Jenis Kelamin';
        }
        if ($formattedBirthdayDatabase !== $formattedBirthdayAccount) {
            $account->birthday = $formattedBirthdayAccount;  
            $updatedFields[] = 'Tanggal Lahir';
        }

        // Jika tidak ada perubahan setelah validasi
        if (empty($updatedFields)) {
            return response()->json([
                'status' => 'warning',
                'message' => 'Tidak ada perubahan pada akun',
            ]);
        }

        // Periksa perubahan dan insert log satu per satu untuk kolom yang berubah
        foreach ($updatedFields as $field) {
            switch ($field) {
                case 'Username':
                    LogAccountsModel::create([
                        'auth_id' => $authId,
                        'column_changed' => 'username',
                        'old_value' => $account->getOriginal('username') ?? '', // Mengambil nilai lama
                        'new_value' => $account->username ?? '',
                    ]);
                    break;

                case 'Nama Lengkap':
                    LogAccountsModel::create([
                        'auth_id' => $authId,
                        'column_changed' => 'name',
                        'old_value' => $account->getOriginal('name') ?? '', // Mengambil nilai lama
                        'new_value' => $account->name ?? '',
                    ]);
                    break;

                case 'Nomor Telepon':
                    LogAccountsModel::create([
                        'auth_id' => $authId,
                        'column_changed' => 'phone',
                        'old_value' => $account->getOriginal('phone') ?? '', // Mengambil nilai lama
                        'new_value' => $account->phone ?? '',
                    ]);
                    break;

                case 'Jenis Kelamin':
                    LogAccountsModel::create([
                        'auth_id' => $authId,
                        'column_changed' => 'gender',
                        'old_value' => $account->getOriginal('gender') ?? '', // Mengambil nilai lama
                        'new_value' => $account->gender ?? '',
                    ]);
                    break;

                case 'Tanggal Lahir':
                    LogAccountsModel::create([
                        'auth_id' => $authId,
                        'column_changed' => 'birthday',
                        'old_value' => $formattedBirthdayDatabase ?? '', // Mengambil nilai lama
                        'new_value' => $formattedBirthdayAccount ?? '',
                    ]);
                    break;
            }
        }

        // Simpan perubahan data ke dalam database
        $account->save();  // Menyimpan perubahan ke tabel account

        // Kembalikan respon sukses
        return response()->json([
            'status' => 'success',
            'message' => implode(', ', $updatedFields) . ' berhasil diperbaharui',
        ]);
    }
}