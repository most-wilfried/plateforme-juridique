<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'avocat') {
            $appointments = Appointment::with(['client'])
                ->where('lawyer_id', $user->id)
                ->orderBy('start_time', 'desc')
                ->get();
        } else {
            $appointments = Appointment::with(['lawyer'])
                ->where('client_id', $user->id)
                ->orderBy('start_time', 'desc')
                ->get();
        }

        return view('appointments.index', compact('appointments', 'user'));
    }
}
