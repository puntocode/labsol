<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValorCertificado extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    /**
     * Get the Valor that owns the ValorCertificado.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function valor()
    {
        return $this->belongsTo(Valor::class);
    }


    public function scopeValorTable($query, $id){
        $query->whereHas('valor', function ($q) use ($id) {
            return $q->where('calibracion_id', $id);
        });
    }
}
