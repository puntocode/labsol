<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EntradaInstrumento extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts   = [ 'contact' => 'array' ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function expedientes(){
        return $this->hasMany(Expediente::class);
    }

    public function getCreatedAtAttribute(){
        return date('d-m-Y', strtotime($this->attributes['created_at']));
    }

    /**
     * Obtiene los egresos de la entrada de instrumentos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function egresoInstrumentos()
    {
        return $this->hasMany(EgresoInstrumento::class);
    }
}
