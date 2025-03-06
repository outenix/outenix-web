<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class AuthsModel extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'auths';  // Menentukan nama tabel yang sesuai

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'auth_id',                  // auth_id
        'name',                      // name
        'email',                     // email
        'email_verified_at',         // email_verified_at
        'email_verification_token',  // email_verification_token
        'password',                  // password
        'remember_token',            // remember_token
        'provider_id',               // provider_id (JSON)
        'provider_name',             // provider_name
        'temporary_auth_token',      // temporary_auth_token
        'ip_address',                // ip_address
        'status',                // status
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password', 
        'remember_token', 
        'email_verification_token', 
        'temporary_auth_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'provider_id' => 'array',    // Cast JSON field to array
        'password' => 'hashed',      // Pastikan password di-hash
    ];
}
