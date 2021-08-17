<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'rank' => 'array',
    ];

    protected $appends = [ 'title' ];

    public function condition(){
        return $this->belongsTo(Condition::class);
    }

    public function magnitude(){
        return $this->belongsTo(Magnitude::class);
    }

    public function alertCalibration(){
        return $this->belongsTo(AlertCalibration::class);
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

    public function getDocuments(){
        $data = [
            'documentos' => $this->documents()->where('document_id', $this->id)->where('document_type', 'App\Models\Equipo')->where('category', 'DOCUMENTOS')->get(),
            'manual' => $this->documents()->where('document_id', $this->id)->where('document_type', 'App\Models\Equipo')->where('category', 'MANUAL')->get(),
            'certificados' => $this->documents()->where('document_id', $this->id)->where('document_type', 'App\Models\Equipo')->where('category', 'CERTIFICADOS')->get(),
        ];

        return $data;
    }


}
