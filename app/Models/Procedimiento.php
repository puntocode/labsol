<?php

namespace App\Models;

use Database\Seeders\InstrumentoProcedimientoSeed;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procedimiento extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = ['accredited_scope' => 'boolean'];
    protected $appends = [ 'fullname' ];
    protected $with = ['patrones', 'ambiental', 'magnitud'];

    public function patrones(){
        return $this->hasMany(PatronProcedimiento::class);
    }

    public function ambiental(){
        return $this->belongsTo(EquipoAmbiental::class, 'equipo_ambiental_id');
    }

    public function instrumentos(){
        return $this->belongsToMany(Instrumento::class);
    }

    public function magnitud(){
        return $this->belongsTo(Magnitude::class, 'magnitud_id');
    }

    public function setValveAttribute($value){
        $this->attributes['valve'] = strtoupper($value);
    }

    public function certificadoURL(){
        return asset('media/docs/procedimientos/'.$this->pdf);
    }


    public function getAlcanceColor(){
        return $this->accredited_scope ? 'success' : 'danger';
    }

    public function accreditedScope(){
        return $this->accredited_scope ? 'SI' : 'NO';
    }

    public function getFullnameAttribute(){
        return $this->name .'  - '. $this->code;
    }
}
