<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class absen extends Model
{
    use HasFactory;

    protected $table= 'absen';
    protected $primaryKey = 'ID_absen';

    protected $fillable =[
        'ID_event',
        'nama',
        'mulai',
        'berakhir'
    ];
}
