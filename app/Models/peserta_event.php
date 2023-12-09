<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peserta_event extends Model
{
    use HasFactory;

    protected $table ='peserta_event';
    protected $primaryKey = 'ID_peserta';

    protected $fillable =[
        'ID_event',
        'nama',
        'email',
        'gender',
        'type',
        'instansi',
        'nama_ruang',
        'no_meja',
        'kode_doorprize',
        'payment_url',
        'payment_status',
        'status_absen',
        'absen_oleh'
    ];

}
