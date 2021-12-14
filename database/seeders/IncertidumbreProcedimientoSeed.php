<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncertidumbreProcedimientoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['procedimiento_id' => 4, 'incertidumbre_id' => 1],
            ['procedimiento_id' => 4, 'incertidumbre_id' => 2],
            ['procedimiento_id' => 4, 'incertidumbre_id' => 3],
            ['procedimiento_id' => 4, 'incertidumbre_id' => 4],
            ['procedimiento_id' => 4, 'incertidumbre_id' => 5],

        ];
        DB::table('incertidumbre_procedimiento')->insert($data);
    }
}
