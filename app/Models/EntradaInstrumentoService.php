<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntradaInstrumentoService extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function entrada(){
        return $this->belongsTo(EntradaInstrumento::class);
    }

    public function instrumento(){
        return $this->belongsTo(Instrumento::class);
    }

}
