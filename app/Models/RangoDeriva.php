<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RangoDeriva extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = [
        'u' => 'array',
        'uc' => 'array',
        'ip' => 'array',
        'deriva' => 'array',
        'e_actual' => 'array',
        'e_anterior' => 'array',
        'oculto' => 'boolean',
    ];

    public function ideRango(){
        return $this->belongsTo(IdeRango::class);
    }

}
