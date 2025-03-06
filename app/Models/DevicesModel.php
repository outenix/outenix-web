<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DevicesModel extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang sesuai dengan model ini.
     *
     * @var string
     */
    protected $table = 'devices';

    /**
     * Kolom yang dapat diisi secara mass-assignment.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'auth_id',     // ID pengguna yang memiliki perangkat
        'device_name', // Nama perangkat
        'browser',     // Informasi browser
        'device',      // Tipe perangkat
        'platform',    // Platform
        'ip_address',  // Alamat IP
        'cookie_token',// Token cookie
        'expired_at',  // Waktu kadaluarsa
        'location',    // Lokasi dari IP
    ];

    /**
     * Relasi dengan model Auth.
     * Menghubungkan perangkat ke pengguna yang memiliki perangkat ini.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function auth()
    {
        return $this->belongsTo(Auth::class, 'auth_id', 'auth_id');
    }
}
