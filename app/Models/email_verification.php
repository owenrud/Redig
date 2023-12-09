<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class email_verification extends Model
{
    use HasFactory;
    
    protected $table = 'email_verification';
    protected $fillable=[
        'ID_user',
        'token',
        'status'
    ];
}
