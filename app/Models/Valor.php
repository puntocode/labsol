<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valor extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = [
        'ip_valor' => 'array',
        'iec_valor' => 'array',
    ];


}
