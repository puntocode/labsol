<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patron extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'rank' => 'array',
        'error_max' => 'array',
        'precision' => 'array',
    ];

    public function statusPattern(){
        return $this->belongsTo(StatusPattern::class);
    }

    public function magnitude(){
        return $this->belongsTo(Magnitude::class);
    }

    public function alertCalibration(){
        return $this->belongsTo(AlertCalibration::class);
    }

    public function alertaCalibracion(){
        if(isset($this->alertCalibration))return $this->alertCalibration->name;
        else return '-';
    }


}
