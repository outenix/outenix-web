<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CredentialsModel extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika tidak mengikuti konvensi penamaan Laravel
    protected $table = 'credentials';

    // Menentukan atribut yang bisa diisi secara massal
    protected $fillable = [
        'auth_id', 
        'aplication_name', 
        'secret_id', 
        'secret_key', 
        'status'
    ];

    // Menentukan relasi dengan tabel 'auths'
    public function auth()
    {
        return $this->belongsTo(AuthsModel::class, 'auth_id', 'auth_id');
    }

    // Menentukan format tanggal khusus jika diperlukan
    // protected $dateFormat = 'Y-m-d H:i:s';
}
