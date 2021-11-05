<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatronEnsayo extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = [
        'rangos' => 'array',
    ];

    public function patron(){
        return $this->belongsTo(Patron::class);
    }


}
