<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historymaintenance extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'reason', 'maintenance_date', 'done', 'obs', 'next_maintenance'];

    public function historymaintenance(){
        return $this->morphTo();
    }

}
