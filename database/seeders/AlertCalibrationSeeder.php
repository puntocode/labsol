<?php

namespace Database\Seeders;

use App\Models\AlertCalibration;
use Illuminate\Database\Seeder;

class AlertCalibrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AlertCalibration::create([
            'name' => 'LOCALES',
            'code' => 'L',
            'description' => '30 días',
        ]);

        AlertCalibration::create([
            'name' => 'EXTERIOR',
            'code' => 'E',
            'description' => '90 días',
        ]);

        AlertCalibration::create([
            'name' => 'NO SE CALIBRA',
            'code' => 'N',
            'description' => 'NO SE CALIBRA',
        ]);

        AlertCalibration::create([
            'name' => 'L/E',
            'code' => 'L/E',
            'description' => 'Local (Si el INTN tiene acreditación) Exterior (Si INTN no tiene)',
        ]);
    }


}
