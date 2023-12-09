<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_event extends Model
{
    use HasFactory;

    protected $table = 'detail_event';
    protected $primaryKey ='ID_event';

    protected $fillable =[
        'ID_event',
        'ID_kategori',
        'alamat',
        'ID_provinsi',
        'ID_kabupaten',
        'lat',
        'long',
        'banner',
        'logo',
        'materi'
    ];
}
