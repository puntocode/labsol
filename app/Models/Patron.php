<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patron extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = [ 'title', 'periodo', 'idioma' ];
    protected $casts = [
        'rank' => 'array',
        'error_max' => 'array',
        'precision' => 'array',
    ];


    public function condition(){
        return $this->belongsTo(Condition::class);
    }

    public function magnitude(){
        return $this->belongsTo(Magnitude::class);
    }

    public function alertCalibration(){
        return $this->belongsTo(AlertCalibration::class);
    }

    public function procedimientos(){
        return $this->belongsTo(Procedimiento::class, 'procedimiento_id');
    }

    public function formulario(){
        return $this->belongsTo(Formulario::class, 'formulario_id');
    }

    public function ensayos(){
        return $this->hasMany(PatronEnsayo::class);
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


    #Mutadores------------------------------------------------------------------------------

    public function alertaCalibracion(){
        if(isset($this->alertCalibration))return $this->alertCalibration->name;
        else return '-';
    }

    public function getTitleAttribute(){
        return 'PATRÓN';
    }


    public function getPeriodoAttribute(){
        $periodo = $this->calibration_period;

        switch($periodo){
            case null: return '-'; break;
            case 1: return $periodo.' Año'; break;
            case $periodo > 1: return $periodo.' Años'; break;
        }
    }

    public function getIdiomaAttribute()
    {
        $manual = $this->documents()->where('document_id', $this->id)->where('document_type', 'App\Models\Patron')->where('category', 'MANUAL')->orderBy('created_at', 'DESC')->first();
        return isset($manual) ? $manual->idioma : '-';
    }


    public function getDocuments(){
        $data = [
            'manual' => $this->documents()->where('document_id', $this->id)->where('document_type', 'App\Models\Patron')->where('category', 'MANUAL')->get(),
            'documentos' => $this->documents()->where('document_id', $this->id)->where('document_type', 'App\Models\Patron')->where('category', 'DOCUMENTOS')->get(),
            // 'certificados' => $this->documents()->where('document_id', $this->id)->where('document_type', 'App\Models\Patron')->where('category', 'CERTIFICADOS')->get(),
        ];

        return $data;
    }


}
