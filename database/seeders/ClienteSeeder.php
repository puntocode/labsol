<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cliente::create([
            'name' => 'AGRO INDUSTRIAL GUARAPI SA',
            'ruc' => '80000402-7',
            'code' => '5188',
            'contact' => [ ['direccion' => 'Legión Civil Extranjera 1049', 'nombre' => 'Fernando Giménez', 'telefono' => '021600130', 'email' => 'fernando.gimenez@guarapi.com.py'], ],
        ]);

        Cliente::create([
            'name'    => 'AJ SA CALIDAD ANTE TODO',
            'ruc'     => '80009641-0',
            'code'    => '5032',
            'contact' => [ ['direccion' => '', 'nombre' => 'María de los Angeles Rozzano', 'telefono' => '', 'email' => 'mariadelosangeles-rozzano@aj.com.py'], ],
        ]);

        Cliente::create([
            'name'    => 'AGROFUTURO PARAGUAY SA',
            'ruc'     => '80031231-7',
            'code'    => '22676',
            'contact' => [
                ['direccion'  => 'Tte 1° Angel Velazco, Nuestra Sra Sta María de Aunción', 'nombre' => 'Shirley Barrio', 'telefono' => '', 'email' => 'laboratorio@agrofuturo.com.py'],
                ['direccion'  => 'Tte 1° Angel Velazco, Nuestra Sra Sta María de Aunción', 'nombre' => 'Jhonny Morínigo', 'telefono' => '', 'email' => 'compras@agrofuturo.com.py']
            ],
        ]);

        Cliente::create([
            'name'    => 'ALCOHOLERA PARAGUAYA SA (ALPASA)',
            'ruc'     => '80029599-4',
            'code'    => '5224',
            'contact' => [
                ['direccion'  => 'Mcal. Lopez 5557 e/ Gral. Benítez', 'nombre' => 'Rodrigo Ferreira', 'telefono' => '', 'email' => 'compras.paraguari.ind@alpasa.com.py'],
                ['direccion'  => 'Mcal. Lopez 5557 e/ Gral. Benítez', 'nombre' => 'Pedro León', 'telefono' => '', 'email' => 'compras.cascada@alpasa.com.py']
            ],
        ]);

        Cliente::create([
            'name'    => 'ALEX SA',
            'ruc'     => '80002740-0',
            'code'    => '5101',
            'contact' => [ ['direccion'  => 'America y Calle 2 - Zarate Isla', 'nombre' => 'Idalino Caballero', 'telefono' => '0984405672', 'email' => 'rojasn@alexsa.com.py'], ],
        ]);

        Cliente::create([
            'name'    => 'ANDRES H. ARCE SA',
            'ruc'     => '80023488-0',
            'code'    => '23613',
            'contact' => [ ['direccion'  => 'Brasil 198', 'nombre' => 'Andres H Arce', 'telefono' => '', 'email' => 'import@aharce.com.py'], ],
        ]);

        Cliente::create([
            'name'    => 'FLORES RODRIGUEZ, LAURA EMILCE',
            'ruc'     => '1684421-1',
            'code'    => '17104',
            'contact' => [ ['direccion'  => 'Diaz de Soliz 2084', 'nombre' => 'Laura Emilce Flores R.', 'telefono' => '0981711953', 'email' => 'floreslaurapy@yahoo.com'], ],
        ]);

        Cliente::create([
            'name'    => 'YAZAKI PARAGUAY SRL',
            'ruc'     => '80079145-2',
            'code'    => '5064',
            'contact' => [
                ['direccion'  => 'Bernardino Caballero 9425 c/Chivato, Mariano Roque Alonso', 'nombre' => 'Laura Caballero', 'telefono' => '0217583341', 'email' => 'laura.britez@py.yazaki.com'],
                ['direccion'  => 'Bernardino Caballero 9425 c/Chivato, Mariano Roque Alonso', 'nombre' => 'Dario lopez', 'telefono' => '0217583306', 'email' => 'dario.sanabria@py.yazaki.com'],
                ['direccion'  => 'Bernardino Caballero 9425 c/Chivato, Mariano Roque Alonso', 'nombre' => 'Shirley Maribel Ortiz Paredes', 'telefono' => '0217583306', 'email' => 'shirley.paredes@py.yazaki.com'],
                ['direccion'  => 'Bernardino Caballero 9425 c/Chivato, Mariano Roque Alonso', 'nombre' => 'Walney Silva', 'telefono' => '0217583306', 'email' => 'walney.silva@br.yazaki.com'],
            ],
        ]);
    }
}
