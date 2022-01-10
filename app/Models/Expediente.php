<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Expediente extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts   = ['tecnicos' => 'array'];
    protected $appends = ['prioridad'];

    public function instrumentos(){
        return $this->belongsTo(Instrumento::class, 'instrumento_id');
    }

    public function entradaInstrumentos(){
        return $this->belongsTo(EntradaInstrumento::class, 'entrada_instrumento_id');
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

    public function calibracion(){
        return $this->hasOne(Calibracion::class);
    }

    public function autorizado(){
        return $this->belongsTo(User::class, 'autorizado_id');
    }

    public function getPrioridadAttribute(){
        $prioridad = [
            'priority' => $this->attributes['priority'],
            'color' => $this->attributes['priority'] == 'NORMAL' ? 'success' : 'danger',
        ];
        return $prioridad;
    }

    public function scopeSuma($query)
    {
        $query->with('estados')
        ->whereNotNull('delivery_date')
        ->groupBy('expediente_estado_id')
        ->selectRaw('count(expediente_estado_id) as sum, expediente_estado_id');
    }

    public function scopeAsignar($query){
        $query->where('expediente_estado_id', 1)->orWhere('expediente_estado_id', 9)->where('tecnicos', null);
    }

    public function scopeRelaciones($query){
        $query->with('instrumentos', 'estados', 'entradaInstrumentos', 'calibracion');
    }

    public function scopeCalibration($query){
        $query->with('entradaInstrumentos.cliente', 'instrumentos.procedimiento.incertidumbres', 'calibracion');
    }

    public function scopeAgenda($query){
        $query->where('expediente_estado_id', 2)->orWhere('expediente_estado_id', 11)->orWhere('expediente_estado_id', 8)->whereNotNull('delivery_date');
    }

    public function scopeCantidad($query, $entrada_id)
    {
        $query->with('instrumentos')
        ->where('entrada_instrumento_id', $entrada_id)
        ->groupBy('instrumento_id')
        ->selectRaw('instrumento_id, count(id) cantidad');
    }

    /**
     * Returns the patterns used for print in Calibration Certificate
     *
     * @return array
     */
    public function getPatternsForCalibrationCertificate()
    {
        $patrones = [];

        if ($this->calibracion->ema) {
            $patrones[] = Patron::where('code', $this->calibracion->ema)->first();
        }

        foreach ($this->calibracion->patrones as $patronCalibracion) {
            foreach ($patronCalibracion['code'] as $code) {
                $patron = Patron::where('code', $code)->first();

                $patron->description = $patronCalibracion['name'];

                $patrones[] = $patron;
            }
        }

        return $patrones;
    }


}
