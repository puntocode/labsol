<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValorIncertidumbre extends Model
{
    use HasFactory;
    protected $fillable = [
        'u',
        'u_du',
        'g_libertad',
        'potencia',
        'incertidumbre_id',
        'valor_id',
    ];
}
