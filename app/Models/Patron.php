<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patron extends Model
{
    use HasFactory;

    protected $casts = [
        'rank' => 'array',
        'error_max' => 'array',
        'precision' => 'array',
    ];

    public function statusPattern(){
        return $this->belongsTo(StatusPattern::class);
    }
}
