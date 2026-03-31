<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\LawyerApprovedNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LawyerApprovalController extends Controller
{
    public function index()
    {
        $pendingLawyers = User::where('role', 'avocat')
            ->where('is_approved', false)
            ->with('lawyerProfile')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('admin.lawyers.pending', compact('pendingLawyers'));
    }

    public function approve(User $lawyer): RedirectResponse
    {
        abort_if($lawyer->role !== 'avocat', 404);

        $lawyer->update([
            'is_approved' => true,
            'approved_at' => now(),
        ]);

        $lawyer->notify(new LawyerApprovedNotification());

        return back()->with('success', 'Le compte avocat a été approuvé et une notification a été envoyée.');
    }
}
