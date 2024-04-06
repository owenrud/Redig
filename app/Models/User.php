<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $primaryKey = 'ID_User';
    protected $fillable = [
        'email',
        'password',
        'Role',
        'email_valid',
        'google_id',
        'ID_paket',
        'nama_lengkap',
        'otp',
        'no_telp',
        'alamat',
        'provinsi',
        'kabupaten',
        'foto'
    ];
    public function isAdmin()
{
    return $this->Role === 'Admin';
}
public function isEO()
{
    return $this->Role === 'EO';
}
}
