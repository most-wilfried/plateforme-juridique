<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DirectoryController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('lawyerProfile')
            ->where('role', 'avocat')
            ->whereHas('lawyerProfile', function ($query) {
                $query->completed();
            });

        if ($request->has('specialty') && $request->specialty) {
            $query->whereHas('lawyerProfile', function ($q) use ($request) {
                $q->whereJsonContains('specialties', $request->specialty);
            });
        }

        $lawyers = $query->get();

        return view('annuaire', compact('lawyers'));
    }

    public function show(User $user)
    {
        abort_if($user->role !== 'avocat', 404);
        abort_if(!$user->lawyerProfile?->isCompleted(), 404);

        $existingRequest = null;
        $auth = auth()->user();

        if ($auth && $auth->role === 'client') {
            $existingRequest = $auth->appointmentsAsClient()
                ->where('lawyer_id', $user->id)
                ->latest()
                ->first();
        }

        return view('directory.show', compact('user', 'existingRequest'));
    }
}
