<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magnitude extends Model
{
    use HasFactory;

    protected $fillable = [ 'name', 'status', 'condition_type', 'unit_measurement' ];

    protected $casts = [
        'unit_measurement' => 'array',
        'status' => 'boolean'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }

    public function getStatusAttribute(){
        return $this->attributes['status'] ? 'ACTIVO' : 'INACTIVO';
    }
}
