<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAccountsModel extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model
    protected $table = 'log_accounts';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'auth_id',
        'column_changed',
        'old_value',
        'new_value',
    ];

    // Pastikan timestamps diaktifkan (default di Laravel)
    public $timestamps = true;

    // Relasi ke tabel auths (opsional)
    public function auth()
    {
        return $this->belongsTo(AuthsModel::class, 'auth_id', 'auth_id');
    }
}
