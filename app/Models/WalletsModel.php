<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class WalletsModel extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang sesuai dengan model ini.
     *
     * @var string
     */
    protected $table = 'wallets';

    /**
     * Kolom yang dapat diisi secara mass-assignment.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'auth_id',    // ID pengguna yang memiliki wallet
        'wallet_id',  // ID wallet
        'balance',    // Saldo dalam wallet
    ];

    /**
     * Tipe data yang harus dikasting.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'balance' => 'decimal:2',  // Mengonversi balance menjadi tipe decimal dengan 2 angka di belakang koma
    ];

    /**
     * Relasi dengan model Auth.
     * Menghubungkan wallet ke pengguna (auth) yang memiliki wallet ini.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function auth()
    {
        return $this->belongsTo(Auth::class, 'auth_id', 'auth_id');
    }
}
