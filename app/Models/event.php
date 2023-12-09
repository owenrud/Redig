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
        'nama_event',
        'desc_event',
        'start',
        'end',
        'public',
        'status',
    ];
}
