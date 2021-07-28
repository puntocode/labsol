<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historycalibration extends Model
{
    use HasFactory;

    protected $fillable = ['certificate_no', 'next_calibration', 'calibration', 'done', 'obs'];

    public function historycalibration(){
        return $this->morphTo();
    }
}
