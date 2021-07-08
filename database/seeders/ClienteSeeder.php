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
            'phone' => '0981123456',
            'adress' => 'Legión Civil Extranjera 1049',
            'contact' => [ ['nombre' => 'Fernando Giménez', 'telefono' => '021600130', 'email' => 'fernando.gimenez@guarapi.com.py'], ],
        ]);

        Cliente::create([
            'name'    => 'AJ SA CALIDAD ANTE TODO',
            'ruc'     => '80009641-0',
            'code'    => '5032',
            'phone'   => '',
            'adress'  => '',
            'contact' => [ ['nombre' => 'María de los Angeles Rozzano', 'telefono' => '', 'email' => 'mariadelosangeles-rozzano@aj.com.py'], ],
        ]);

        Cliente::create([
            'name'    => 'AGROFUTURO PARAGUAY SA',
            'ruc'     => '80031231-7',
            'code'    => '22676',
            'phone'   => '021680260',
            'adress'  => 'Tte 1° Angel Velazco, Nuestra Sra Sta María de Aunción',
            'contact' => [ ['nombre' => 'Shirley Barrio', 'telefono' => '', 'email' => 'laboratorio@agrofuturo.com.py'], ['nombre' => 'Jhonny Morínigo', 'telefono' => '', 'email' => 'compras@agrofuturo.com.py'] ],
        ]);

        Cliente::create([
            'name'    => 'ALCOHOLERA PARAGUAYA SA (ALPASA)',
            'ruc'     => '80029599-4',
            'code'    => '5224',
            'phone'   => '021608311',
            'adress'  => 'Mcal. Lopez 5557 e/ Gral. Benítez',
            'contact' => [ ['nombre' => 'Rodrigo Ferreira', 'telefono' => '', 'email' => 'compras.paraguari.ind@alpasa.com.py'], ['nombre' => 'Pedro León', 'telefono' => '', 'email' => 'compras.cascada@alpasa.com.py'] ],
        ]);

        Cliente::create([
            'name'    => 'ALEX SA',
            'ruc'     => '80002740-0',
            'code'    => '5101',
            'phone'   => '',
            'adress'  => 'America y Calle 2 - Zarate Isla',
            'contact' => [ ['nombre' => 'Idalino Caballero', 'telefono' => '0984405672', 'email' => 'rojasn@alexsa.com.py'], ],
        ]);

        Cliente::create([
            'name'    => 'ANDRES H. ARCE SA',
            'ruc'     => '80023488-0',
            'code'    => '23613',
            'phone'   => '',
            'adress'  => 'Brasil 198',
            'contact' => [ ['nombre' => 'Andres H Arce', 'telefono' => '', 'email' => 'import@aharce.com.py'], ],
        ]);

        Cliente::create([
            'name'    => 'FLORES RODRIGUEZ, LAURA EMILCE',
            'ruc'     => '1684421-1',
            'code'    => '17104',
            'phone'   => 'Diaz de Soliz 2084',
            'adress'  => 'Brasil 198',
            'contact' => [ ['nombre' => 'Laura Emilce Flores R.', 'telefono' => '0981711953', 'email' => 'floreslaurapy@yahoo.com'], ],
        ]);
    }
}
