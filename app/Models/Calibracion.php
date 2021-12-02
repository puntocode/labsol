<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calibracion extends Model
{
    use HasFactory;

    protected $casts = [ 'patrones' => 'array'];
    protected $fillable  = [
        'expediente_id',
        'nro_serie',
        'identificacion',
        'unidad_medida',
        'tipo',
        'resolucion',
        'resolucion_medida',
        'intervalo_medida',
        'intervalo_desde',
        'intervalo_hasta',
        'marca',
        'especificacion_marca',
        'modelo',
        'ema',
        'patrones',
        'lugar',
        'temperatura_inicial',
        'temperatura_final',
        'obs',
        'humedad_inicial',
        'humedad_final',
        'fecha_inicio',
        'fecha_fin',
        'user_id',
    ];


}
