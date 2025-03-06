<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramMessagesModel extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang sesuai dengan tabel di database
    protected $table = 'telegram_messages';

    // Tentukan kolom yang dapat diisi (fillable)
    protected $fillable = [
        'group_id',
        'user_id',
        'name',
        'message_text',
        'message_photo',
        'message_video',
        'message_sticker',
        'message_gif',
        'message_other',
        'last_message',
    ];
}
