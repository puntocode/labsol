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
                [ 'title' => 'precision', 'value' => ['Grado 0'] ],
            ],
            'error_max' => [
                [ 'title' => 'error', 'value' => ['± 0,02 %'] ],
            ],
        ]);


        Patron::create([
            'code'               => 'PCD-02',
            'description'        => 'Bloque de 125 mm',
            'rank'               => ['125 mm'],
            'brand'              => 'Starrett',
            'precision' => [
                [ 'title' => 'precision', 'value' => ['Grado AS1'] ],
            ],
            'error_max' => [
                [ 'title' => 'error', 'value' => ['± 0,02 %'] ],
            ],
            'calibration_period' => '3 Años',
            'certificate_no'     => '25P42318',
            'last_calibration'   => '2018/06/26',
            'next_calibration'   => '2021/06/26',
            'status_pattern_id'  => '1',
            'magnitude_id'       => '1',
        ]);

        Patron::create([
            'code'               => 'PCD-03',
            'description'        => 'Regla patrón de longitud',
            'rank'               => ['0 mm - 1000 mm'],
            'brand'              => 'Trofeo',
            'precision' => [
                [ 'title' => 'precision', 'value' => ['0,50 mm'] ],
            ],
            'error_max' => [
                [ 'title' => 'error', 'value' => ['± 0,02 %'] ],
            ],
            'calibration_period' => '3 Años',
            'certificate_no'     => '',
            'status_pattern_id'  => '3',
            'magnitude_id'       => '1',
        ]);

        Patron::create([
            'code'               => 'PCD-04',
            'description'        => 'Regla de cristal',
            'rank'               => ['0 mm - 200 mm'],
            'brand'              => 'Easson',
            'precision' => [
                [ 'title' => 'precision', 'value' => ['1 mm'] ],
            ],
            'error_max' => [
                [ 'title' => 'error', 'value' => ['± 0,02 %'] ],
            ],
            'calibration_period' => '2 Años',
            'certificate_no'     => 'LS7587-2019',
            'last_calibration'   => '2019/11/14',
            'next_calibration'   => '2021/11/14',
            'status_pattern_id'  => '1',
            'magnitude_id'       => '1',
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
                [ 'title' => 'VAC', 'value' => ['1 kV – 28 kV: ± 5 %'] ],
                [ 'title' => 'VDC', 'value' => ['1 kV – 20 kV: ± 1 %', '20 kV – 40 kV: ± 2 %'] ],
            ],
            'error_max' => [
                [ 'title' => 'VAC', 'value' => ['± 5,00 %'] ],
                [ 'title' => 'VDC', 'value' => ['± 1,00 %', '± 2,00 %'] ],
            ],
        ]);
    }
}
