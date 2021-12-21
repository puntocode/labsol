<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incertidumbre extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contribucion',
        'tipo',
        'nombre',
        'distribucion',
        'formula',
        'fuente',
        'divisor',
        'grados_libertad_for',
        'coeficiente',
        'contribucion_du'
    ];
}
