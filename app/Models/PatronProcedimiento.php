<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatronProcedimiento extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = [ 'code' => 'array'];
}
