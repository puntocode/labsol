<?php

namespace App\Models;

use App\Casts\Contacto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['name','ruc','adress','contact'];


    protected $casts = [
        'contact' => 'array'
    ];


}
