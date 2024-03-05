<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    use HasFactory;

    protected $table ='profile';
    protected $primaryKey ='ID_User';
    public $timestamps = false;

    protected $fillable =[
        'ID_User',
        'ID_paket',
        'nama_lengkap',
        'no_telp',
        'alamat',
        'provinsi',
        'kota',
        'foto'
    ];
}
