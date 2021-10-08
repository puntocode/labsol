<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatronIde extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function patron(){
        return $this->belongsTo(Patron::class);
    }


}
