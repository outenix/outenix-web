<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountsModel extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang sesuai dengan model ini.
     *
     * @var string
     */
    protected $table = 'accounts'; // Mengubah nama tabel menjadi 'accounts'

    /**
     * Kolom yang dapat diisi secara mass-assignment.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'auth_id',
        'username',
        'name',
        'phone',
        'birthday',
        'gender',
        'status',
        'profile_picture',
    ];

    /**
     * Kolom yang harus di-cast ke tipe data tertentu.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birthday' => 'date',
    ];

    /**
     * Relasi dengan model AuthsModel.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function auth()
    {
        return $this->belongsTo(AuthsModel::class, 'auth_id', 'auth_id');
    }
}
