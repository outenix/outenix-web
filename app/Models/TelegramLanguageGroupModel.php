<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramLanguageGroupModel extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model ini
    protected $table = 'telegram_group_languages';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'group_id',
        'group_language_code',
    ];

    /**
     * Relasi ke model TelegramGroup.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(TelegramGroupsModel::class, 'group_id', 'group_id');
    }
}