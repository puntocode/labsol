<?php

namespace Database\Seeders;

use App\Models\CalibrationStatus;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(AlertCalibrationSeeder::class);
        $this->call(StatusPaternSeeder::class);
        $this->call(StatusCalibrationSeeder::class);
        $this->call(MagnitudeSeeder::class);
        $this->call(PatronSeeder::class);
    }
}
