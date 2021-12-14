<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instrumento extends Model
{
    use HasFactory;

    protected $appends = [ 'code' ];

    public function procedimiento(){
        return $this->belongsToMany(Procedimiento::class);
    }

    public function getCodeAttribute(){
        return $this->name;
    }
}
