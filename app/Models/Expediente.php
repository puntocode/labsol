<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts   = [ 'tecnicos' => 'array' ];

    public function servicios(){
        return $this->belongsTo(EntradaInstrumentoService::class, 'entrada_instrumento_service_id');
    }

    public function estados(){
        return $this->belongsTo(ExpedienteEstado::class, 'expediente_estado_id');
    }

    public function getDeliveryDateAttribute(){
        return $this->attributes['delivery_date'] ? date('d/m/Y', strtotime($this->attributes['delivery_date'])) : '-';
    }

    public function historial(){
        return $this->hasMany(ExpedienteHistorial::class);
    }

    public function scopeSuma($query)
    {
        $query->with('estados')
        ->whereNotNull('delivery_date')
        ->groupBy('expediente_estado_id')
        ->selectRaw('count(expediente_estado_id) as sum, expediente_estado_id');
    }


}
