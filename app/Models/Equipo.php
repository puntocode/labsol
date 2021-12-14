<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = [ 'title', 'periodo', 'idioma' ];
    protected $casts   = [ 'rank' => 'array'];


    public function condition(){
        return $this->belongsTo(Condition::class);
    }

    public function magnitude(){
        return $this->belongsTo(Magnitude::class);
    }

    public function alertCalibration(){
        return $this->belongsTo(AlertCalibration::class);
    }

    public function formulario(){
        return $this->belongsTo(Formulario::class);
    }

    public function procedimientos(){
        return $this->belongsTo(Procedimiento::class, 'procedimiento_id');
    }

    public function documents(){
        return $this->morphMany(Document::class, 'document');
    }

    public function historycalibrations(){
        return $this->morphMany(Historycalibration::class, 'historycalibration');
    }

    public function historymaintenances(){
        return $this->morphMany(Historymaintenance::class, 'historymaintenance');
    }

    public function getTitleAttribute(){
        return 'EQUIPO';
    }

    public function getPeriodoAttribute(){
        $periodo = $this->calibration_period;

        switch($periodo){
            case null: return '-'; break;
            case 1: return $periodo.' Año'; break;
            case $periodo > 1: return $periodo.' Años'; break;
        }
    }

    public function getDocuments(){
        $data = [
            'manual' => $this->documents()->where('document_id', $this->id)->where('document_type', 'App\Models\Equipo')->where('category', 'MANUAL')->get(),
            'documentos' => $this->documents()->where('document_id', $this->id)->where('document_type', 'App\Models\Equipo')->where('category', 'DOCUMENTOS')->get(),
        ];

        return $data;
    }

    public function getIdiomaAttribute()
    {
        $manual = $this->documents()->where('document_id', $this->id)->where('document_type', 'App\Models\Equipo')->where('category', 'MANUAL')->first();
        return isset($manual) ? $manual->idioma : '-';
    }


}
