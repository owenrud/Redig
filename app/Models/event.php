<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class event extends Model
{
    use HasFactory;
    
    protected $table = 'event';
    protected $primaryKey ='ID_event';
    
    protected $fillable =[
        'ID_paket',
        'ID_EO',
        'ID_kategori',
        'ID_provinsi',
        'ID_kabupaten',
        'nama_event',
        'desc_event',
        'lokasi',
        'alamat',
        'latitude',
        'longitude',
        'start',
        'end',
        'public',
        'status',
        'banner',
        'logo',
        'materi'
    ];
}
