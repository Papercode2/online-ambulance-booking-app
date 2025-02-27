<?php
// database/seeders/DatabaseSeeder.php
use Illuminate\Database\Seeder;
use App\Models\Ambulance;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Ambulance::truncate(); // Clear previous data

        Ambulance::create([
            'name' => 'Emergency One',
            'plate_number' => 'KDH 123A',
            'status' => 'available'
        ]);

        Ambulance::create([
            'name' => 'Rescue Med',
            'plate_number' => 'KDJ 456B',
            'status' => 'booked'
        ]);

        Ambulance::create([
            'name' => 'Life Saver',
            'plate_number' => 'KDL 789C',
            'status' => 'available'
        ]);
    }
}
