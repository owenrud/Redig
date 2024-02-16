<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class operator extends Model
{
    use HasFactory;
    protected $table = 'operator';
    protected $primaryKey ='ID_operator';

    protected $fillable=[
        'ID_event',
        'ID_User',
    ];
}
