<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProcedimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prodecimientos = [
            [
                'code' => 'LS-PRO-C01',
                'name' => 'Calibración de medios isotermos',
                'revision' => 1,
                'valve' => 'RC',
                'accredited_scope' => 1,
            ],
            [
                'code' => 'LS-PRO-C02',
                'name' => 'Calibración de termómetros digitales y analógicos',
                'revision' => 2,
                'valve' => 'RC',
                'accredited_scope' => 1,
            ],
            [
                'code' => 'LS-PRO-C03',
                'name' => 'Calibración de amperímetro',
                'revision' => 0,
                'valve' => 'RC',
                'accredited_scope' => 1,
            ],
            [
                'code' => 'LS-PRO-C04',
                'name' => 'Calibración de presión',
                'revision' => 1,
                'valve' => 'RC',
                'accredited_scope' => 1,
            ],
            [
                'code' => 'LS-PRO-C05',
                'name' => 'Calibración de cinta métrica',
                'revision' => 0,
                'valve' => 'RC',
                'accredited_scope' => 1,
            ],
            [
                'code' => 'LS-PRO-C06',
                'name' => 'Calibración de cuentametro',
                'revision' => 0,
                'valve' => 'RC',
                'accredited_scope' => 0,
            ],
            [
                'code' => 'LS-PRO-C07',
                'name' => 'Calibración de balanza',
                'revision' => 1,
                'valve' => 'RC',
                'accredited_scope' => 0,
            ],
            [
                'code' => 'LS-PRO-C08',
                'name' => 'Calibración de calibre pie de rey',
                'revision' => 1,
                'valve' => 'RC',
                'accredited_scope' => 1,
            ],
            [
                'code' => 'LS-PRO-C09',
                'name' => 'Calibración de medidor de espesor',
                'revision' => 0,
                'valve' => 'RC',
                'accredited_scope' => 0,
            ],
            [
                'code' => 'LS-PRO-C10',
                'name' => 'Calibración de micrómetro',
                'revision' => 0,
                'valve' => 'RC',
                'accredited_scope' => 1,
            ],
            [
                'code' => 'LS-PRO-C11',
                'name' => 'Calibración de regla',
                'revision' => 0,
                'valve' => 'RC',
                'accredited_scope' => 1,
            ],
            [
                'code' => 'LS-PRO-C12',
                'name' => 'Calibración de reloj comparador',
                'revision' => 0,
                'valve' => 'RC',
                'accredited_scope' => 1,
            ],
            [
                'code' => 'LS-PRO-C13',
                'name' => 'Calibración de medidor de humedad',
                'revision' => 0,
                'valve' => 'RC',
                'accredited_scope' => 0,
            ],
            [
                'code' => 'LS-PRO-C14',
                'name' => 'Calibración de termómetros infrarrojos',
                'revision' => 0,
                'valve' => 'RC',
                'accredited_scope' => 0,
            ],
            [
                'code' => 'LS-PRO-C15',
                'name' => 'Calibración de indicador electrónico de temperatura',
                'revision' => 0,
                'valve' => 'RC',
                'accredited_scope' => 1,
            ],
            [
                'code' => 'LS-PRO-C16',
                'name' => 'Calibración de sensores de temperatura',
                'revision' => 0,
                'valve' => 'RC',
                'accredited_scope' => 1,
            ],
            [
                'code' => 'LS-PRO-C17',
                'name' => 'Calibración de termohigrómetros',
                'revision' => 0,
                'valve' => 'RC',
                'accredited_scope' => 1,
            ],
            [
                'code' => 'LS-PRO-C18',
                'name' => 'Calibración de proyector de perfil',
                'revision' => 0,
                'valve' => 'RC',
                'accredited_scope' => 0,
            ],
            [
                'code' => 'LS-PRO-C19',
                'name' => 'Calibración de calibre pasa no pasa',
                'revision' => 0,
                'valve' => 'RC',
                'accredited_scope' => 0,
            ],
            [
                'code' => 'LS-PRO-C20',
                'name' => 'Calibración de fuente de tensión',
                'revision' => 0,
                'valve' => 'RC',
                'accredited_scope' => 0,
            ],
            [
                'code' => 'LS-PRO-C21',
                'name' => 'Calibración de spark tester',
                'revision' => 0,
                'valve' => 'RC',
                'accredited_scope' => 0,
            ],
            [
                'code' => 'LS-PRO-C22',
                'name' => 'Calibración de instrumentos de medición de baja resistencia eléctrica',
                'revision' => 0,
                'valve' => 'RC',
                'accredited_scope' => 1,
            ],
            [
                'code' => 'LS-PRO-C23',
                'name' => 'Calibración de instrumentos de medición de alta resistencia eléctrica',
                'revision' => 0,
                'valve' => 'RC',
                'accredited_scope' => 1,
            ],
            [
                'code' => 'LS-PRO-C24',
                'name' => 'Calibración de voltímetro',
                'revision' => 0,
                'valve' => 'RC',
                'accredited_scope' => 1,
            ],
            [
                'code' => 'LS-PRO-C25',
                'name' => 'Calibración de multímetros',
                'revision' => 0,
                'valve' => 'RC',
                'accredited_scope' => 1,
            ],
            [
                'code' => 'LS-PRO-C26',
                'name' => 'Calibración de dinamómetro',
                'revision' => 0,
                'valve' => 'RC',
                'accredited_scope' => 0,
            ],
            [
                'code' => 'LS-PRO-C27',
                'name' => 'Calibración de anillo dinamométrico',
                'revision' => 0,
                'valve' => 'RC',
                'accredited_scope' => 0,
            ],
            [
                'code' => 'LS-PRO-C28',
                'name' => 'Calibración de torquímetro',
                'revision' => 0,
                'valve' => 'RC',
                'accredited_scope' => 0,
            ],
            [
                'code' => 'LS-PRO-C29',
                'name' => 'Calibración de durómetro',
                'revision' => 0,
                'valve' => 'RC',
                'accredited_scope' => 0,
            ],
            [
                'code' => 'LS-PRO-C31',
                'name' => 'Calibración de válvula de seguridad',
                'revision' => 0,
                'valve' => 'RC',
                'accredited_scope' => 0,
            ],
            [
                'code' => 'LS-PRO-C32',
                'name' => 'Calibración de conductivímetro',
                'revision' => 0,
                'valve' => 'RC',
                'accredited_scope' => 0,
            ],
            [
                'code' => 'LS-PRO-C33',
                'name' => 'Calibración de pHmetro',
                'revision' => 0,
                'valve' => 'RC',
                'accredited_scope' => 0,
            ],
            [
                'code' => 'LS-PRO-C34',
                'name' => 'Calibración de variador de velocidad',
                'revision' => 0,
                'valve' => 'RC',
                'accredited_scope' => 0,
            ],
            [
                'code' => 'LS-PRO-C35',
                'name' => 'Calibración de luxómetro',
                'revision' => 0,
                'valve' => 'RC',
                'accredited_scope' => 1,
            ],
            [
                'code' => 'LS-PRO-C36',
                'name' => 'Calibración de cronómetro',
                'revision' => 0,
                'valve' => 'RC',
                'accredited_scope' => 1,
            ],
            [
                'code' => 'LS-PRO-C37',
                'name' => 'Calibración de sonómetro',
                'revision' => 0,
                'valve' => 'RC',
                'accredited_scope' => 1,
            ],
        ];
        DB::table('procedimientos')->insert($prodecimientos);
    }
}
