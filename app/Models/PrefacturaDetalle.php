<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrefacturaDetalle extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'prefactura_id',
        'expediente_id',
        'sector',
        'costo',
        'fecha_envio_certificado',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'fecha_envio_certificado' => 'datetime',
    ];

    /**
     * Obtiene la prefactura del detalle.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prefactura()
    {
        return $this->belongsTo(Prefactura::class);
    }

    /**
     * Obtiene el expediente del detalle.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function expediente()
    {
        return $this->belongsTo(Expediente::class);
    }
}
