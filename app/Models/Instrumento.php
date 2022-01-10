<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instrumento extends Model
{
    use HasFactory;

    protected $appends = [ 'code' ];
    protected $casts = [ 'status' => 'boolean'];

    public function procedimiento(){
        return $this->belongsToMany(Procedimiento::class);
    }

    public function getCodeAttribute(){
        return $this->name;
    }

    public function getStatusAttribute(){
        return $this->attributes['status'] ? 'ACTIVO' : 'INACTIVO';
    }
}
