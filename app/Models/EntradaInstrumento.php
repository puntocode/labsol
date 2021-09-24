<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntradaInstrumento extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts   = [ 'contact' => 'array' ];
    // protected $with    = [ 'servicio'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function instrumento(){
        return $this->belongsTo(Instrumento::class);
    }

    public function servicio(){
        return $this->hasMany(EntradaInstrumentoService::class);
    }

    public function getCreatedAtAttribute(){
        return date('d-m-Y', strtotime($this->attributes['created_at']));
    }


}
