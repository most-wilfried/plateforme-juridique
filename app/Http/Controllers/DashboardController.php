<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function client()
    {
        $user = Auth::user();

        $messages = Message::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $contacts = User::whereIn('id', $messages->pluck('sender_id')
            ->merge($messages->pluck('receiver_id'))
            ->unique()
            ->filter()
            ->reject(fn ($id) => $id === $user->id))
            ->get();

        $appointments = $user->appointmentsAsClient()->latest('start_time')->take(5)->get();
        $documentsCount = $user->documents()->count();

        return view('client.tableau-de-bord', compact('user', 'messages', 'contacts', 'appointments', 'documentsCount'));
    }

    public function avocat()
    {
        $user = Auth::user();

        $messages = Message::where('receiver_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $clients = User::whereIn('id', $messages->pluck('sender_id')->unique()->filter())
            ->get();

        $appointments = $user->appointmentsAsLawyer()->latest('start_time')->take(5)->get();
        $documentsCount = Document::whereHas('appointment', fn ($query) => $query->where('lawyer_id', $user->id))->count();

        return view('avocat.tableau-de-bord', compact('user', 'messages', 'clients', 'appointments', 'documentsCount'));
    }

    public function admin()
    {
        $clients = User::where('role', 'client')
            ->orderBy('name')
            ->get();

        $lawyers = User::with('lawyerProfile')
            ->where('role', 'avocat')
            ->orderBy('name')
            ->get();

        $stats = [
            'users' => User::count(),
            'clients' => $clients->count(),
            'lawyers' => $lawyers->count(),
        ];

        return view('admin.tableau-de-bord', compact('stats', 'clients', 'lawyers'));
    }
}
