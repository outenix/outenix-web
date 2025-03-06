<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAuthsModel extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang sesuai dengan model ini.
     *
     * @var string
     */
    protected $table = 'log_auths';

    /**
     * Kolom yang dapat diisi secara mass-assignment.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'auth_id',       // ID pengguna yang melakukan autentikasi
        'device_name',   // Nama perangkat yang digunakan
        'browser',       // Nama browser yang digunakan
        'device',        // Jenis perangkat (misalnya: mobile, desktop)
        'platform',      // Platform
        'ip_address',    // Alamat IP perangkat
        'auth_at',       // Metode autentikasi (mail, google, dll.)
        'location',      // Lokasi dari IP
    ];

    /**
     * Relasi dengan model AuthsModel.
     * Menghubungkan auth_id dengan tabel auths.
     */
    public function auth()
    {
        return $this->belongsTo(AuthsModel::class, 'auth_id', 'auth_id');
    }
}