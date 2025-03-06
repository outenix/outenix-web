<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramMaintenanceModel extends Model
{
    use HasFactory;

    protected $table = 'telegram_maintenance'; // Nama tabel di database

    protected $fillable = ['status']; // Kolom yang bisa diisi secara massal
}
