<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramGroupAdministratorsModel extends Model
{
    use HasFactory;

    protected $table = 'telegram_group_administrators';

    protected $fillable = [
        'group_id',
        'user_id',
        'administrator_first_name',
        'administrator_last_name',
        'administrator_username',
        'administrator_type',
        'administrator_status'
    ];

    public function group()
    {
        return $this->belongsTo(TelegramGroupsModel::class, 'group_id', 'group_id');
    }
}
