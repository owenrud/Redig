<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    use HasFactory;
    protected $table ='invoice';
    
    protected $fillable =[
        'ID_paket',
        'ID_user',
        'Payment_id',
        'bill_key',
        'biller_code',
        'Type',
        'status',
        'total'
    ];
}
