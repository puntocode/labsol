<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpedienteHistorial extends Model
{
    use HasFactory;
    protected $casts = [ 'tecnicos' => 'array' ];
    protected $fillable = ['expediente_id', 'tecnicos', 'delivery_date'];

    public function expediente(){
        return $this->belongsTo(Expediente::class);
    }

    public function getDeliveryDateAttribute(){
        return date('d/m/Y', strtotime($this->attributes['delivery_date']));
    }

}
