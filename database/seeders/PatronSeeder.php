<?php

namespace Database\Seeders;

use App\Models\Patron;
use Illuminate\Database\Seeder;

class PatronSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Patron::create([
            'code'               => 'PCD-01',
            'description'        => 'Juego de bloques patrón',
            'rank'               => ['2,5 mm - 75 mm'],
            'brand'              => 'Starrett',
            'calibration_period' => '3 Años',
            'certificate_no'     => '59844Y18',
            'last_calibration'   => '2018/06/26',
            'next_calibration'   => '2021/06/26',
            'status_pattern_id'  => '1',
            'magnitude_id'       => '1',
            'precision' => [
                ['Grado 0'],
            ],
            'error_max' => [
                ['± 0,02 %'],
            ],
        ]);

        Patron::create([
            'code'               => 'PCE-01',
            'description'        => 'Punta atenuadora de tensión',
            'rank'               => ['0 KV - 28 KV (AC)', '0 KV  - 40 KV (DC)'],
            'brand'              => 'Minipa',
            'calibration_period' => '2 Años',
            'certificate_no'     => '',
            'last_calibration'   => null,
            'next_calibration'   => null,
            'status_pattern_id'  => '3',
            'magnitude_id'       => '2',
            'precision' => [
                ['vac'  => '1 kV – 28 kV: ± 5 %' ],
                ['VDC'  => ['1 kV – 20 kV: ± 1 %', '20 kV – 40 kV: ± 2 %'] ],
            ],
            'error_max' => [
                ['vac'  => '± 5,00 %' ],
                ['VDC'  => ['± 1,00 %', '± 2,00 %'] ],
            ],
        ]);
    }
}
