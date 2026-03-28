<?php

namespace App\Http\Controllers;

use App\Models\LawyerProfile;
use App\Models\Specialty;
use Illuminate\Http\Request;

class LawyerProfileController extends Controller
{
    public function edit(Request $request)
    {
        $user = $request->user();
        $profile = LawyerProfile::firstOrCreate(['user_id' => $user->id]);

        $specialties = Specialty::orderBy('name')->get();

        if ($specialties->isEmpty()) {
            $specialties = collect([
                ['id' => 1, 'name' => 'Droit de la famille'],
                ['id' => 2, 'name' => 'Droit pénal'],
                ['id' => 3, 'name' => 'Droit du travail'],
                ['id' => 4, 'name' => 'Droit commercial'],
                ['id' => 5, 'name' => 'Droit immobilier'],
                ['id' => 6, 'name' => 'Droit des affaires'],
                ['id' => 7, 'name' => 'Droit fiscal'],
                ['id' => 8, 'name' => 'Droit de la propriété intellectuelle'],
            ]);
        }

        return view('lawyer-profile.edit', compact('profile', 'specialties'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'bar_number' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'experience_years' => 'nullable|integer|min:0|max:100',
            'bio' => 'nullable|string|max:5000',
            'city' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'hourly_rate' => 'nullable|numeric|min:0|max:999999.99',
            'currency' => 'nullable|string|max:10',
            'specialties' => 'nullable|string',
            'languages' => 'nullable|string',
            'working_days' => 'nullable|array',
            'working_days.*' => 'in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            'work_start' => 'nullable|date_format:H:i',
            'work_end' => 'nullable|date_format:H:i|after:work_start',
        ]);

        $validated['specialties'] = $this->parseTags($request->input('specialties'));
        $validated['languages'] = $this->parseTags($request->input('languages'));
        $validated['working_days'] = $request->input('working_days', []);

        $profile = LawyerProfile::updateOrCreate(
            ['user_id' => $request->user()->id],
            array_merge($validated, ['user_id' => $request->user()->id])
        );

        return back()->with('status', 'Profil avocat enregistré avec succès.');
    }

    protected function parseTags(?string $input): array
    {
        if (!$input) {
            return [];
        }

        return array_values(array_filter(array_map('trim', explode(',', $input))));
    }
}
