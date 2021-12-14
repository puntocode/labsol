<?php

namespace Database\Seeders;

use App\Models\Incertidumbre;
use Illuminate\Database\Seeder;

class IncertidumbreSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Incertidumbre::create([
            'contribucion' => 'EBC',
            'nombre' => 'Incertidumbre repetibilidad EBC',
            'tipo' => 'A',
            'distribucion' => 'normal',
            'formula' => 'u_rep_ebc',
            'fuente' => '𝑠',
            'divisor' => '√3',
            'coeficiente' => 1,
            'contribucion_du' => 1,
            'grados_libertad_for' => 'n-1',
        ]);

        Incertidumbre::create([
            'contribucion' => 'EBC',
            'nombre' => 'Incertidumbre resolución EBC',
            'tipo' => 'B',
            'distribucion' => 'rectangular',
            'formula' => 'u_res_ebc',
            'fuente' => '𝑟/2',
            'divisor' => '√3',
            'coeficiente' => 1,
            'contribucion_du' => 1,
            'grados_libertad_for' => '∞',
        ]);

        Incertidumbre::create([
            'contribucion' => 'PATRON',
            'nombre' => 'Incertidumbre patrón',
            'tipo' => 'B',
            'distribucion' => 'normal',
            'formula' => 'p_inc_p',
            'fuente' => 'U',
            'divisor' => 'k',
            'coeficiente' => 1,
            'contribucion_du' => 1,
            'grados_libertad_for' => '∞',
        ]);

        Incertidumbre::create([
            'contribucion' => 'PATRON',
            'nombre' => 'Incertidumbre resolución patrón',
            'tipo' => 'B',
            'distribucion' => 'rectangular',
            'formula' => 'p_inc_res',
            'fuente' => '𝑟/2',
            'divisor' => '√3',
            'coeficiente' => 1,
            'contribucion_du' => 1,
            'grados_libertad_for' => '∞',
        ]);

        Incertidumbre::create([
            'contribucion' => 'PATRON',
            'nombre' => 'Incertidumbre repetibilidad patrón',
            'tipo' => 'A',
            'distribucion' => 'normal',
            'formula' => 'p_inc_rep',
            'fuente' => '𝑠',
            'divisor' => '√3',
            'coeficiente' => 1,
            'contribucion_du' => 1,
            'grados_libertad_for' => 'n-1',
        ]);
    }
}
