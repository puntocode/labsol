<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prefactura extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cliente_id',
        'total',
        'observacion',
        'cerrada',
        'fecha_cierre',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'fecha_cierre' => 'datetime',
    ];

     /**
     * Obtiene el cliente de la prefactura.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Obtiene los detalles de la prefactura.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prefacturaDetalles()
    {
        return $this->hasMany(PrefacturaDetalle::class);
    }
}
