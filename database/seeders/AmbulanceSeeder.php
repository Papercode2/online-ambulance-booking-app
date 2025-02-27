<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Ambulance;

class AmbulanceSeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Truncate the table
        Ambulance::truncate();
        
        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Insert dummy data
        Ambulance::create([
            'driver_name' => 'John Doe',
            'driver_phone' => '0712345678',
            'status' => 'available',
            'vehicle_number' => 'KDA 123A'
        ]);

        Ambulance::create([
            'driver_name' => 'Jane Smith',
            'driver_phone' => '0723456789',
            'status' => 'booked',
            'vehicle_number' => 'KDB 456B'
        ]);
    }
}
