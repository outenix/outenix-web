<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramLanguageBotModel extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model ini
    protected $table = 'telegram_bot_languages';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'user_id',
        'bot_language_code',
    ];

    /**
     * Relasi ke model TelegramUser.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(TelegramUsersModel::class, 'user_id', 'user_id');
    }
}
