<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalibracionHistorial extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = [ 'anteriores' => 'array', 'nuevos' => 'array' ];

    public function getCreatedAtAttribute(){
        return date('d-m-Y', strtotime($this->attributes['created_at']));
    }

}
