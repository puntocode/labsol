<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstrumentoProcedimientoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['procedimiento_id' => 1, 'instrumento_id' => 1,],
            ['procedimiento_id' => 1, 'instrumento_id' => 2,],
            ['procedimiento_id' => 1, 'instrumento_id' => 3,],
            ['procedimiento_id' => 1, 'instrumento_id' => 4,],
            ['procedimiento_id' => 2, 'instrumento_id' => 5,],
            ['procedimiento_id' => 2, 'instrumento_id' => 6,],
            ['procedimiento_id' => 2, 'instrumento_id' => 7,],
            ['procedimiento_id' => 3, 'instrumento_id' => 8,],
            ['procedimiento_id' => 3, 'instrumento_id' => 9,],
            ['procedimiento_id' => 4, 'instrumento_id' => 10,],
            ['procedimiento_id' => 4, 'instrumento_id' => 11,],
            ['procedimiento_id' => 4, 'instrumento_id' => 12,],
            ['procedimiento_id' => 4, 'instrumento_id' => 13,],
            ['procedimiento_id' => 4, 'instrumento_id' => 14,],
            ['procedimiento_id' => 4, 'instrumento_id' => 15,],
            ['procedimiento_id' => 4, 'instrumento_id' => 16,],
            ['procedimiento_id' => 5, 'instrumento_id' => 17,],
            ['procedimiento_id' => 5, 'instrumento_id' => 18,],
            ['procedimiento_id' => 6, 'instrumento_id' => 19,],
            ['procedimiento_id' => 6, 'instrumento_id' => 20,],
            ['procedimiento_id' => 6, 'instrumento_id' => 21,],
            ['procedimiento_id' => 7, 'instrumento_id' => 22,],
            ['procedimiento_id' => 7, 'instrumento_id' => 23,],
            ['procedimiento_id' => 7, 'instrumento_id' => 24,],
            ['procedimiento_id' => 7, 'instrumento_id' => 25,],
            ['procedimiento_id' => 8, 'instrumento_id' => 26,],
            ['procedimiento_id' => 8, 'instrumento_id' => 27,],
            ['procedimiento_id' => 8, 'instrumento_id' => 28,],
            ['procedimiento_id' => 9, 'instrumento_id' => 29,],
            ['procedimiento_id' => 10, 'instrumento_id' => 30,],
            ['procedimiento_id' => 11, 'instrumento_id' => 31,],
            ['procedimiento_id' => 11, 'instrumento_id' => 32,],
            ['procedimiento_id' => 12, 'instrumento_id' => 33,],
            ['procedimiento_id' => 13, 'instrumento_id' => 34,],
            ['procedimiento_id' => 13, 'instrumento_id' => 35,],
            ['procedimiento_id' => 13, 'instrumento_id' => 36,],
            ['procedimiento_id' => 13, 'instrumento_id' => 37,],
            ['procedimiento_id' => 14, 'instrumento_id' => 38,],
            ['procedimiento_id' => 14, 'instrumento_id' => 39,],
            ['procedimiento_id' => 15, 'instrumento_id' => 40,],
            ['procedimiento_id' => 15, 'instrumento_id' => 41,],
            ['procedimiento_id' => 16, 'instrumento_id' => 42,],
            ['procedimiento_id' => 16, 'instrumento_id' => 43,],
            ['procedimiento_id' => 16, 'instrumento_id' => 44,],
            ['procedimiento_id' => 16, 'instrumento_id' => 45,],
            ['procedimiento_id' => 16, 'instrumento_id' => 46,],
            ['procedimiento_id' => 16, 'instrumento_id' => 47,],
            ['procedimiento_id' => 16, 'instrumento_id' => 48,],
            ['procedimiento_id' => 16, 'instrumento_id' => 49,],
            ['procedimiento_id' => 16, 'instrumento_id' => 50,],
            ['procedimiento_id' => 16, 'instrumento_id' => 51,],
            ['procedimiento_id' => 16, 'instrumento_id' => 52,],
            ['procedimiento_id' => 17, 'instrumento_id' => 53,],
            ['procedimiento_id' => 17, 'instrumento_id' => 54,],
            ['procedimiento_id' => 17, 'instrumento_id' => 55,],
            ['procedimiento_id' => 18, 'instrumento_id' => 56,],
            ['procedimiento_id' => 19, 'instrumento_id' => 57,],
            ['procedimiento_id' => 20, 'instrumento_id' => 58,],
            ['procedimiento_id' => 20, 'instrumento_id' => 59,],
            ['procedimiento_id' => 20, 'instrumento_id' => 60,],
            ['procedimiento_id' => 21, 'instrumento_id' => 61,],
            ['procedimiento_id' => 22, 'instrumento_id' => 62,],
            ['procedimiento_id' => 22, 'instrumento_id' => 63,],
            ['procedimiento_id' => 22, 'instrumento_id' => 64,],
            ['procedimiento_id' => 23, 'instrumento_id' => 65,],
            ['procedimiento_id' => 24, 'instrumento_id' => 66,],
            ['procedimiento_id' => 25, 'instrumento_id' => 67,],
            ['procedimiento_id' => 26, 'instrumento_id' => 68,],
            ['procedimiento_id' => 27, 'instrumento_id' => 69,],
            ['procedimiento_id' => 28, 'instrumento_id' => 70,],
            ['procedimiento_id' => 28, 'instrumento_id' => 71,],
            ['procedimiento_id' => 29, 'instrumento_id' => 72,],
            ['procedimiento_id' => 30, 'instrumento_id' => 73,],
            ['procedimiento_id' => 31, 'instrumento_id' => 74,],
            ['procedimiento_id' => 32, 'instrumento_id' => 75,],
            ['procedimiento_id' => 33, 'instrumento_id' => 76,],
            ['procedimiento_id' => 33, 'instrumento_id' => 77,],
            ['procedimiento_id' => 34, 'instrumento_id' => 78,],
            ['procedimiento_id' => 35, 'instrumento_id' => 79,],
            ['procedimiento_id' => 36, 'instrumento_id' => 80,],
            ['procedimiento_id' => 36, 'instrumento_id' => 81,]
        ];

        DB::table('instrumento_procedimiento')->insert($data);
    }
}
