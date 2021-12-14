<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstrumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('instrumentos')->insert([
            ['name' => 'Estufa',],
            ['name' => 'Incubadora',],
            ['name' => 'Baño termostático',],
            ['name' => 'Autoclave',],
            ['name' => 'Termómetro',],
            ['name' => 'Termómetro de líquido en vidrio',],
            ['name' => 'Termostato',],
            ['name' => 'Amperímetro',],
            ['name' => 'Pinza Amperométrica',],
            ['name' => 'Manómetro',],
            ['name' => 'Vacuómetro',],
            ['name' => 'Manovacuómetro',],
            ['name' => 'Presostato',],
            ['name' => 'Manómetro diferencial',],
            ['name' => 'Transmisor de presión',],
            ['name' => 'Transmisor de presión diferencial',],
            ['name' => 'Cinta métrica',],
            ['name' => 'Cinta pilón',],
            ['name' => 'Cuentametro',],
            ['name' => 'Cuentametro láser',],
            ['name' => 'Podómetro',],
            ['name' => 'Balanza analítica',],
            ['name' => 'Balanza',],
            ['name' => 'Balanza de gancho',],
            ['name' => 'Comparador mecánico',],
            ['name' => 'Calibre pie de rey',],
            ['name' => 'Calibre de altura',],
            ['name' => 'Calibre de profundidad',],
            ['name' => 'Medidor de espesor',],
            ['name' => 'Micrómetro',],
            ['name' => 'Regla',],
            ['name' => 'Regla de cristal',],
            ['name' => 'Reloj comparador',],
            ['name' => 'Medidor de humedad en granos',],
            ['name' => 'Medidor de humedad en cartón',],
            ['name' => 'Humidímetro',],
            ['name' => 'Termobalanza',],
            ['name' => 'Termometro Infrarrojo',],
            ['name' => 'Cámara Termográfica',],
            ['name' => 'Pirómetro',],
            ['name' => 'Indicador de temperatura',],
            ['name' => 'Sensor de temperatura tipo J',],
            ['name' => 'Sensor de temperatura tipo K',],
            ['name' => 'Sensor de temperatura tipo B',],
            ['name' => 'Sensor de temperatura tipo C',],
            ['name' => 'Sensor de temperatura tipo N',],
            ['name' => 'Sensor de temperatura tipo R',],
            ['name' => 'Sensor de temperatura tipo S',],
            ['name' => 'Sensor de temperatura tipo T',],
            ['name' => 'Sensor de temperatura tipo PT100 Ω',],
            ['name' => 'Sensor de temperatura tipo PT25Ω',],
            ['name' => 'Sensor de temperatura tipo PT1000 Ω',],
            ['name' => 'Termohigrómetro',],
            ['name' => 'Datalogger',],
            ['name' => 'Transmisor de Termperatura y Humedad',],
            ['name' => 'Proyector de perfil',],
            ['name' => 'Calibre pasa no pasa',],
            ['name' => 'Fuente de tensión AC',],
            ['name' => 'Fuente de tensión DC',],
            ['name' => 'Fuente de tensión AC/DC',],
            ['name' => 'Spark tester',],
            ['name' => 'Ohmetro',],
            ['name' => 'Microhmetro',],
            ['name' => 'Telurómetro',],
            ['name' => 'Megohmetro',],
            ['name' => 'Voltímetro',],
            ['name' => 'Multímetro',],
            ['name' => 'Dinamómetro',],
            ['name' => 'Aro dinamométrico',],
            ['name' => 'Torquímetro',],
            ['name' => 'Calibrador de torquímetro',],
            ['name' => 'Durómetro',],
            ['name' => 'Válvula de seguridad',],
            ['name' => 'Conductivímetro',],
            ['name' => 'pHmetro',],
            ['name' => 'Variador de velocidad',],
            ['name' => 'Tacómetro',],
            ['name' => 'Luxómetro',],
            ['name' => 'Cronómetro',],
            ['name' => 'Sonómetro',],
            ['name' => 'Decibelímetro',],
            ['name' => 'Multicalibrador de termperatura',],
            ['name' => 'Horno isotérmico'],
            ['name' => 'Termorresistencia'],
            ['name' => 'Multicalibrador eléctrico'],
            ['name' => 'Adapatador de pinzas amperométricas'],
            ['name' => 'Lupa graduada'],
            ['name' => 'Juego de pesas patrón'],
            ['name' => 'Pesas'],
            ['name' => 'Juego de bloques patrón'],
            ['name' => 'Bloque de 125mm'],
            ['name' => 'Galgas de espesor'],
            ['name' => 'Planos ópticos'],
            ['name' => 'Regla patrón'],
            ['name' => 'Mesa de planitud'],
            ['name' => 'Cabezal micrométrico'],
            ['name' => 'Cámara climática'],
            ['name' => 'Patrón utilizado'],
            ['name' => 'Punta atenuadora'],
            ['name' => 'Patrón de resistencias bajas'],
            ['name' => 'Patrón de resistencias altas'],
            ['name' => 'Patrón de torque'],
            ['name' => 'Mutlicalibrador eléctrico'],
            ['name' => 'Máquina de tracción'],
            ['name' => 'Solución de conductividad'],
            ['name' => 'Solución de PH'],
            ['name' => 'Calibrador acústico'],
        ]);
    }
}
