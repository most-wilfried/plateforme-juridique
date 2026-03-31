<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $documents = Document::with(['appointment', 'user'])
            ->where(function ($query) use ($user) {
                if ($user->role === 'avocat') {
                    $query->where('user_id', $user->id)
                        ->orWhereHas('appointment', function ($query) use ($user) {
                            $query->where('lawyer_id', $user->id);
                        })
                        ->orWhereHas('user.appointmentsAsClient', function ($query) use ($user) {
                            $query->where('lawyer_id', $user->id);
                        });
                } else {
                    $query->where('user_id', $user->id);
                }
            })
            ->latest()
            ->get();

        $appointments = [];
        if ($user->role === 'avocat') {
            $appointments = Appointment::where('lawyer_id', $user->id)->latest()->take(10)->get();
        } else {
            $appointments = Appointment::where('client_id', $user->id)->latest()->take(10)->get();
        }

        return view('documents.index', compact('documents', 'appointments', 'user'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $this->authorize('create', Document::class);

        $validated = $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png,gif|max:10240',
            'appointment_id' => 'nullable|exists:appointments,id',
        ]);

        if (! empty($validated['appointment_id'])) {
            $appointmentExists = Appointment::where('id', $validated['appointment_id'])
                ->where(function ($query) use ($user) {
                    $query->where('client_id', $user->id)
                        ->orWhere('lawyer_id', $user->id);
                })
                ->exists();

            abort_unless($appointmentExists, 403);
        }

        $file = $validated['file'];
        $path = $file->store('documents/'.$user->id, 'public');

        $document = Document::create([
            'user_id' => $user->id,
            'appointment_id' => $validated['appointment_id'] ?? null,
            'file_path' => $path,
            'file_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getClientMimeType(),
            'size' => $file->getSize(),
        ]);

        return back()->with('success', 'Document ajouté avec succès.');
    }

    public function download(Document $document)
    {
        $this->authorize('download', $document);

        return Storage::disk('public')->download($document->file_path, $document->file_name);
    }
}
