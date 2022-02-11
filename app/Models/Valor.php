<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valor extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['resultados', 'certificados'];
    protected $casts = [
        'ip_valor' => 'array',
        'iec_valor' => 'array',
    ];

    public function resultados(){
        return $this->hasOne(ValorResultado::class);
    }

    public function certificados(){
        return $this->hasOne(ValorCertificado::class);
    }

    public function incertidumbreResultados(){
        return $this->hasOne(ValorIncertidumbreResultado::class);
    }

    public function incertidumbres(){
        return $this->hasMany(ValorIncertidumbre::class);
    }



}
