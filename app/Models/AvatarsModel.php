<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvatarsModel extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'avatars';

    // Kolom yang dapat diisi
    protected $fillable = [
        'avatar_code',  // Kode unik untuk avatar
        'avatar_pack',  // Pack avatar
        'avatar_type',  // Jenis avatar ('member' atau 'premium')
        'avatar_file',  // File avatar
    ];

    // Opsional: atribut lain yang ingin Anda tambahkan
}
