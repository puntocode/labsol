<?php

namespace Database\Seeders;

use App\Models\StatusCalibration;
use Illuminate\Database\Seeder;

class StatusCalibrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusCalibration::create([
            'name'        => 'EN ESPERA',
            'description' => 'El instrumento ya está dentro del Lab sin asignación de técnico.',
        ]);

        StatusCalibration::create([
            'name'        => 'EN PROCESO',
            'description' => 'El instrumento ya se encuentra asignado a un técnico.',
        ]);

        StatusCalibration::create([
            'name'        => 'COMPLETADA',
            'description' => 'Ya se han tomado datos de medición y generado el certificado de calibración.',
        ]);

        StatusCalibration::create([
            'name'        => 'APROBADA',
            'description' => 'Se ha aprobado el certificado de calibración.',
        ]);

        StatusCalibration::create([
            'name'        => 'FACTURADA',
            'description' => 'Se ha generado factura del servicio de calibración.',
        ]);

        StatusCalibration::create([
            'name'        => 'ANULADA',
            'description' => 'No se realizará/terminará la calibración.',
        ]);

        StatusCalibration::create([
            'name'        => 'EN SUSPENCION',
            'description' => 'Metrólogo postergó la calibración para revisión posterior.',
        ]);

        StatusCalibration::create([
            'name'        => 'EN REVISION',
            'description' => 'Gerente devolvió al metrólogo calibración para revisión.',
        ]);

        StatusCalibration::create([
            'name'        => 'RECHAZADA',
            'description' => 'Gerente devolvió a Jefe de Laboratorio para nueva.',
        ]);

        StatusCalibration::create([
            'name'        => 'PREFACTURADO',
            'description' => 'Se ha añadido el expediente a una planilla de liquidación.',
        ]);
    }
}
