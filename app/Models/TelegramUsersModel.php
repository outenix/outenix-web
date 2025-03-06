<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramUsersModel extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang sesuai dengan tabel di database
    protected $table = 'telegram_users';

    // Tentukan kolom yang dapat diisi (fillable)
    protected $fillable = [
        'user_id',
        'user_firstname',
        'user_lastname',
        'user_username',
        'user_language_code',
        'user_is_premium',
        'user_status',
        'user_profile_picture',
    ];
}
