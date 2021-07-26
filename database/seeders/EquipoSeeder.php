<?php

namespace Database\Seeders;

use App\Models\Equipo;
use Illuminate\Database\Seeder;

class EquipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Equipo::create([
            'code'                 => 'EE-01',
            'description'          => 'Balanza',
            'rank'                 => ['0 g - 100 g'],
            'brand'                => 'S&B',
            'resolution'           => '0,0001 g',
            'error_max'            => '0,1 g',
            'calibration_period'   => '12 meses',
            'certificate_no'       => 'LS10108-2020',
            'last_calibration'     => '2020/07/10',
            'next_calibration'     => '2021/07/10',
            'condition_id'         => '1',
            'magnitude_id'         => '9',
            'alert_calibration_id' => '1'
        ]);

        Equipo::create([
            'code'                 => 'EE-02',
            'description'          => 'Fuente de tensión',
            'rank'                 => ['0 kV - 5 kV'],
            'brand'                => 'Tonghui Electronic',
            'resolution'           => '0,01 kV',
            'error_max'            => '± 2 %',
            'calibration_period'   => '12 meses',
            'certificate_no'       => 'LS10109-2020',
            'last_calibration'     => '2020/06/10',
            'next_calibration'     => '2021/06/10',
            'condition_id'         => '1',
            'magnitude_id'         => '5',
            'alert_calibration_id' => '1'
        ]);

        Equipo::create([
            'code'                 => 'EE-03',
            'description'          => 'Estufa',
            'rank'                 => ['0 °C - 150°C'],
            'brand'                => 'Heraeus',
            'resolution'           => '0,1 °C',
            'error_max'            => '± 2 °C',
            'calibration_period'   => '12 meses',
            'condition_id'         => '1',
            'magnitude_id'         => '14',
            'alert_calibration_id' => '1'
        ]);

        Equipo::create([
            'code'                 => 'EE-04',
            'description'          => 'Máquina de tracción',
            'rank'                 => ['0 kN - 50 kN'],
            'brand'                => 'JZLTMM Co. Ltd.',
            'resolution'           => '1 N',
            'error_max'            => '± 1 %',
            'calibration_period'   => '12 meses',
            'certificate_no'       => 'UMCI-DMEN-LFU No. 2000',
            'last_calibration'     => '2020/09/10',
            'next_calibration'     => '2021/09/10',
            'condition_id'         => '1',
            'magnitude_id'         => '6',
            'alert_calibration_id' => '1'
        ]);

        Equipo::create([
            'code'                 => 'EE-05',
            'description'          => 'Calibre digital',
            'rank'                 => ['0 mm - 150 mm'],
            'brand'                => 'Truper',
            'resolution'           => '0,01 mm',
            'error_max'            => '± 0,02 mm',
            'calibration_period'   => '12 meses',
            'condition_id'         => '2',
            'magnitude_id'         => '3',
            'alert_calibration_id' => '1'
        ]);
    }
}
