<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramModeratorsModel extends Model
{
    use HasFactory;

    protected $table = 'telegram_moderators';

    protected $fillable = ['user_id', 'name', 'type', 'status'];

    /**
     * Relasi ke tabel telegram_users
     */
    public function telegramUser()
    {
        return $this->belongsTo(TelegramUsersModel::class, 'user_id', 'user_id');
    }
}
