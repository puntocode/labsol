<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procedimiento extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $with = ['instrumento', 'patron'];
    protected $casts = ['accredited_scope' => 'boolean'];


    public function setValveAttribute($value){
        $this->attributes['valve'] = strtoupper($value);
    }

    public function instrumento(){
        return $this->belongsToMany(Instrumento::class);
    }

    public function patron(){
        return $this->belongsToMany(Patron::class);
    }

    public function getAlcanceColor(){
        return $this->accredited_scope ? 'success' : 'danger';
    }

    public function accreditedScope(){
        return $this->accredited_scope ? 'SI' : 'NO';
    }
}
