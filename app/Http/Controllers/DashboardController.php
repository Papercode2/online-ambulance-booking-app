<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ambulance;
use App\Models\Booking;

class DashboardController extends Controller
{
    /**
     * Show the ambulance booking panel.
     */
    public function index()
    {
        // Fetch available ambulances
        $ambulances = Ambulance::all();

        // Fetch the user's booking history (assuming user authentication)
        $bookings = Booking::where('user_id', auth()->id())->get();

        return view('dashboard', compact('ambulances', 'bookings'));
    }

    /**
     * Handle ambulance booking request.
     */
    public function bookAmbulance(Request $request)
    {
        $request->validate([
            'pickup' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        Booking::create([
            'user_id' => auth()->id(),
            'pickup' => $request->pickup,
            'destination' => $request->destination,
            'phone' => $request->phone,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Ambulance booked successfully!');
    }
}
