<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpedienteEstado extends Model
{
    use HasFactory;
    protected $casts = ['status' => 'boolean'];

    public function scopeActivo($query){
        $query->where('status', true);
    }

    public function scopeAgenda($query){
        $query->where('id', 2)->orWhere('id', 11)->orWhere('id', 8)->orWhere('id', 7);
    }

}
