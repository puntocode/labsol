<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpedienteHistorial extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function expediente(){
        return $this->belongsTo(Expediente::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function estadoNuevo(){
        return $this->belongsTo(ExpedienteEstado::class, 'estado_nuevo');
    }

    public function getCreatedAtAttribute(){
        return date('d-m-y / H:m', strtotime($this->attributes['created_at']));
    }

}
