<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class provinsi extends Model
{
    use HasFactory;

    protected $table ='provinsi';
    protected $primaryKey ='ID_provinsi';

    protected $fillable =[
        'ID_provinsi',
        'nama'
    ];
}
