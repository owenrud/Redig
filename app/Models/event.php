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
    // Define inverse relationships
    public function paket()
    {
        return $this->belongsTo(paket::class, 'ID_paket', 'ID_paket');
    }

    public function profile()
    {
        return $this->hasOne(User::class, 'ID_User', 'ID_EO');
    }

    public function kategoriEvent()
    {
        return $this->hasOne(kategori_event::class, 'id', 'ID_kategori');
    }

    public function provinsi()
    {
        return $this->hasOne(provinsi::class, 'ID_provinsi', 'ID_provinsi');
    }

    public function kabupaten()
    {
        return $this->hasOne(kabupaten::class, 'id', 'ID_kabupaten');
    }
}
