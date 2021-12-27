<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValorResultado extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    /**
     * Returns the result for valors
     *
     * @return array
     */
    public static function getValorResults($valors)
    {
        $results = [];
        foreach ($valors as $valor) {
            $result = ValorResultado::where('valor_id', $valor->id)->first();
            array_push($results, $result);
        }

        return $results;
    }

}
