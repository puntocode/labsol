<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'rank' => 'array',
    ];

    protected $appends = [ 'title' ];

    public function condition(){
        return $this->belongsTo(Condition::class);
    }

    public function magnitude(){
        return $this->belongsTo(Magnitude::class);
    }

    public function alertCalibration(){
        return $this->belongsTo(AlertCalibration::class);
    }

    public function getTitleAttribute(){
        return 'EQUIPO';
    }


}
