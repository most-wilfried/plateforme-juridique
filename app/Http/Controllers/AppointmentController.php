<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
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

    public function store(Request $request, User $user)
    {
        $client = Auth::user();

        abort_unless($client->role === 'client', 403);
        abort_if($user->role !== 'avocat', 404);

        $request->validate([
            'notes' => 'nullable|string|max:2000',
        ]);

        $existing = Appointment::where('client_id', $client->id)
            ->where('lawyer_id', $user->id)
            ->latest()
            ->first();

        if ($existing && in_array($existing->status, ['pending', 'accepted'])) {
            return back()->with('warning', 'Vous avez déjà une demande en cours avec cet avocat.');
        }

        Appointment::create([
            'client_id' => $client->id,
            'lawyer_id' => $user->id,
            'start_time' => null,
            'end_time' => null,
            'status' => 'pending',
            'notes' => $request->input('notes'),
        ]);

        return back()->with('success', 'Votre demande a été envoyée à l’avocat.');
    }

    public function accept(Appointment $appointment)
    {
        $user = Auth::user();

        abort_unless($user->role === 'avocat', 403);
        abort_if($appointment->lawyer_id !== $user->id, 403);
        abort_unless($appointment->status === 'pending', 400);

        $appointment->update(['status' => 'accepted']);

        return back()->with('success', 'Demande de rendez-vous acceptée. Le client peut maintenant vous contacter.');
    }

    public function reject(Appointment $appointment)
    {
        $user = Auth::user();

        abort_unless($user->role === 'avocat', 403);
        abort_if($appointment->lawyer_id !== $user->id, 403);
        abort_unless($appointment->status === 'pending', 400);

        $appointment->update(['status' => 'rejected']);

        return back()->with('success', 'Demande de rendez-vous refusée.');
    }
}
