<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntradaInstrumentoService extends Model
{
    use HasFactory;

    protected $with    = ['instrumento'];
    protected $guarded = ['id'];
    protected $appends = ['prioridad'];


    public function entrada(){
        return $this->belongsTo(EntradaInstrumento::class);
    }

    public function instrumento(){
        return $this->belongsTo(Instrumento::class);
    }

    public function expedientes(){
        return $this->hasMany(Expediente::class);
    }

    public function getPrioridadAttribute(){
        $prioridad = [
            'prioridad' => $this->attributes['priority'] === 'NORMAL' ? 'NORMAL' : 'URGENTE - 24HS.',
            'color' => $this->attributes['priority'] === 'NORMAL' ? 'primary' : 'danger'
        ];
        return $prioridad;
    }

}
