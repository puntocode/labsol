<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdeRango extends Model
{
    use HasFactory;

    public function patronIde(){
        return $this->belongsTo(PatronIde::class);
    }

    public function rangoDerivas(){
        return $this->hasMany(RangoDeriva::class);
    }

}
