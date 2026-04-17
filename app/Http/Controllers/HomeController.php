<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $lawyerCount = User::where('role', 'avocat')
            ->whereHas('lawyerProfile', function ($query) {
                $query->completed();
            })
            ->count();

        return view('accueil', compact('lawyerCount'));
    }
}
