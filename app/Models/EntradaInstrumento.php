<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntradaInstrumento extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $appends = ['prioridad'];
    protected $casts = [
        'contact' => 'array',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function procedimiento(){
        return $this->belongsTo(Procedimiento::class);
    }


    public function getPrioridadAttribute(){
        $prioridad = [
            'prioridad' => $this->attributes['priority'] === 'NORMAL' ? 'NORMAL' : 'URGENTE - 24HS.',
            'color' => $this->attributes['priority'] === 'NORMAL' ? 'primary' : 'danger'
        ];
        return $prioridad;
    }


}
