<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paket extends Model
{
    use HasFactory;

    protected $table = 'paket';
    protected $primaryKey = 'ID_paket';

    protected $fillable =[
        'nama_paket',
        'ID_fitur',
        'harga'
    ];

}
