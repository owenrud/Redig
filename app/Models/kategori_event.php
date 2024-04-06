<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori_event extends Model
{
    use HasFactory;

    protected $table ='kategori_event';

    public function events()
    {
        return $this->hasMany(Event::class, 'ID_kategori', 'ID_kategori');
    }
    
    protected $fillable =[
        'nama'
    ];
}
