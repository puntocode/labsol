<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipoAmbiental extends Model
{
    use HasFactory;
    protected $casts = ['code' => 'array'];
    protected $fillable = ['code'];
}
