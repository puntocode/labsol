<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts   = [ 'contact' => 'array' ];

    /**
     * Obtiene las entradas de instrumento del cliente.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function entradaInstrumentos()
    {
        return $this->hasMany(EntradaInstrumento::class);
    }

    /**
     * Obtiene los expedientes del cliente.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function expedientes()
    {
        return $this->hasManyThrough(Expediente::class, EntradaInstrumento::class);
    }
}
