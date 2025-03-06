<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramGroupsModel extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang sesuai dengan tabel di database
    protected $table = 'telegram_groups';

    // Tentukan kolom yang dapat diisi (fillable)
    protected $fillable = [
        'group_id',
        'group_owner',
        'group_name',
        'group_description',
        'group_link',
        'group_profile_picture',
        'group_admin_count',
        'group_member_count',
        'group_member_block_count',
        'group_chat_count',
        'group_status',
        'group_type',
    ];
}