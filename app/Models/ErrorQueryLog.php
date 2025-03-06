<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrorQueryLog extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak mengikuti konvensi
    protected $table = 'error_query_logs';

    // Tentukan kolom yang bisa diisi
    protected $fillable = [
        'user_id',
        'error_at',
        'error_title',
        'error_code',
        'is_read',
        'created_at',
    ];

    // Jika ingin menambahkan atribut timestamp untuk created_at dan updated_at
    public $timestamps = false;  // Hapus baris ini jika ingin menggunakan default timestamp Laravel

    // Tentukan tipe data untuk setiap kolom jika perlu
    protected $casts = [
        'created_at' => 'datetime',
    ];
}
