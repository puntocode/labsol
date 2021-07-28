<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procedimiento extends Model
{
    use HasFactory;

    protected $guarded = [];
    //protected $with = ['instrumento', 'patron'];
    protected $casts = ['accredited_scope' => 'boolean'];
    protected $appends = [ 'patron_id', 'instrumento_id' ];


    public function setValveAttribute($value){
        $this->attributes['valve'] = strtoupper($value);
    }

    public function instrumento(){
        return $this->belongsToMany(Instrumento::class);
    }

    public function patron(){
        return $this->belongsToMany(Patron::class);
    }

    public function documents(){
        return $this->morphMany(Document::class, 'document');
    }

    public function getAlcanceColor(){
        return $this->accredited_scope ? 'success' : 'danger';
    }

    public function accreditedScope(){
        return $this->accredited_scope ? 'SI' : 'NO';
    }

    public function getPatronIdAttribute(){
        return $this->patron()->get()->pluck('id');
    }

    public function getInstrumentoIdAttribute(){
        return $this->instrumento()->get()->pluck('id');
    }
}
