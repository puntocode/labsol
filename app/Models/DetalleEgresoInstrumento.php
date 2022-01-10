<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetalleEgresoInstrumento extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'expediente_id',
        'egreso_instrumento_id'
    ];

    /**
     * Obtiene el expediente del egreso.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function expediente()
    {
        return $this->belongsTo(Expediente::class);
    }
}
