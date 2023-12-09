<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fitur_paket extends Model
{
    use HasFactory;

    protected $table ='fitur_paket';
    protected $primaryKey ='ID_fitur';

    protected $fillable=[
        'scan_count',
        'file_up_count',
        'guest_count',
        'operator_count',
        'sertif_count',
        
    ];
}
