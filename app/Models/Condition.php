<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    use HasFactory;

    public function scopePatron($query){
        $query->where('condition_type', 'TODOS')->orWhere('condition_type', 'PATRON');
    }

    public function scopeEquipo($query){
        $query->where('condition_type', 'TODOS')->orWhere('condition_type', 'EQUIPO');
    }


}
