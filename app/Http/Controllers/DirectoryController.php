<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DirectoryController extends Controller
{
    public function index()
    {
        $lawyers = User::with('lawyerProfile')
            ->where('role', 'avocat')
            ->whereHas('lawyerProfile', function ($query) {
                $query->completed();
            })
            ->get();

        return view('annuaire', compact('lawyers'));
    }

    public function show(User $user)
    {
        abort_if($user->role !== 'avocat', 404);
        abort_if(!$user->lawyerProfile?->isCompleted(), 404);

        return view('directory.show', compact('user'));
    }
}
