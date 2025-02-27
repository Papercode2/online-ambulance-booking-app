<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ambulance;

class AmbulanceController extends Controller
{
    /**
     * Show the form for creating a new ambulance.
     */
    public function create()
    {
        return view('ambulances.create'); // Ensure this Blade file exists
    }

    /**
     * Store a newly created ambulance in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'driver_name' => 'required|string|max:255',
            'driver_phone' => 'required|string|max:15',
            'vehicle_number' => 'required|string|max:255',
            'plate_number' => 'required|string|unique:ambulances,plate_number|max:255',
        ]);

        Ambulance::create([
            'driver_name' => $request->driver_name,
            'driver_phone' => $request->driver_phone,
            'vehicle_number' => $request->vehicle_number,
            'plate_number' => $request->plate_number,
            'status' => 'available', // Default value
        ]);

        return redirect()->route('ambulances.index')->with('success', 'Ambulance added successfully.');
    }
}
