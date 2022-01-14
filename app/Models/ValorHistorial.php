<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValorHistorial extends Model
{
    use HasFactory;

    protected $casts = [
        'ip_valor' => 'array',
        'iec_valor' => 'array',
    ];

    public function calibracion(){
        return $this->belongsTo(Calibracion::class);
    }

}
