<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EgresoInstrumento extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'entrada_instrumento_id',
        'fecha',
        'entregado_por',
        'recibido_por',
        'identificacion',
        'observaciones',
        'tipo_retiro',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'fecha' => 'datetime',
    ];

    /**
     * Obtiene la entrada del egreso.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entradaInstrumento()
    {
        return $this->belongsTo(EntradaInstrumento::class);
    }

    /**
     * Obtiene los detalles del egreso.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detalleEgresoInstrumentos()
    {
        return $this->hasMany(DetalleEgresoInstrumento::class);
    }

    /**
     * Obtiene los expedientes del egreso.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function expedientes()
    {
        return $this->belongsToMany(Expediente::class, 'detalle_egreso_instrumentos');
    }

    /**
     * Obtiene el usuario que lo entrega.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entregadoPor()
    {
        return $this->belongsTo(User::class, 'entregado_por');
    }
}
