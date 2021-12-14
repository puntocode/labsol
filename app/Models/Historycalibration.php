<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historycalibration extends Model
{
    use HasFactory;

    protected $fillable = ['certificate', 'certificate_no', 'next_calibration', 'calibration', 'done', 'obs'];

    public function historycalibration(){
        return $this->morphTo();
    }

    public function getUrlCertificate(){
        return asset("media/docs/historial-calibracion/". $this->certificate);
    }

}