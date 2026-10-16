<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Student;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegistrationController extends Controller
{
    /**
     * Afficher les inscriptions avec recherche et pagination.
     */
    public function index(Request $request)
    {
        $search = trim((string) $request->input('search', ''));

        $registrations = Registration::with(['student', 'formation'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('statut', 'like', "%{$search}%")
                        ->orWhere('date_inscription', 'like', "%{$search}%")
                        ->orWhereHas('student', function ($studentQuery) use ($search) {
                            $studentQuery->where('nom', 'like', "%{$search}%")
                                ->orWhere('prenom', 'like', "%{$search}%");
                        })
                        ->orWhereHas('formation', function ($formationQuery) use ($search) {
                            $formationQuery->where('nom', 'like', "%{$search}%");
                        });
                });
            })
            ->orderByDesc('date_inscription')
            ->paginate(10)
            ->withQueryString();

        return view('registrations.index', compact(
            'registrations',
            'search'
        ));
    }

    /**
     * Afficher le formulaire de création.
     */
    public function create()
    {
        $students = Student::orderBy('nom')->orderBy('prenom')->get();
        $formations = Formation::orderBy('nom')->get();

        return view('registrations.create', compact(
            'students',
            'formations'
        ));
    }

    /**
     * Enregistrer une nouvelle inscription.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'integer', 'exists:students,id'],
            'formation_id' => ['required', 'integer', 'exists:formations,id'],
            'date_inscription' => ['required', 'date'],
            'statut' => ['required', Rule::in(['active', 'terminee'])],
        ]);

        Registration::create($validated);

        return redirect()
            ->route('registrations.index')
            ->with('success', 'Inscription ajoutée avec succès.');
    }

    /**
     * Afficher une inscription.
     */
    public function show(string $id)
    {
        $registration = Registration::with(['student', 'formation'])
            ->findOrFail($id);

        return view('registrations.show', compact('registration'));
    }

    /**
     * Afficher le formulaire de modification.
     */
    public function edit(string $id)
    {
        $registration = Registration::findOrFail($id);

        $students = Student::orderBy('nom')->orderBy('prenom')->get();
        $formations = Formation::orderBy('nom')->get();

        return view('registrations.edit', compact(
            'registration',
            'students',
            'formations'
        ));
    }

    /**
     * Mettre à jour une inscription.
     */
    public function update(Request $request, string $id)
    {
        $registration = Registration::findOrFail($id);

        $validated = $request->validate([
            'student_id' => ['required', 'integer', 'exists:students,id'],
            'formation_id' => ['required', 'integer', 'exists:formations,id'],
            'date_inscription' => ['required', 'date'],
            'statut' => ['required', Rule::in(['active', 'terminee'])],
        ]);

        $registration->update($validated);

        return redirect()
            ->route('registrations.index')
            ->with('success', 'Inscription modifiée avec succès.');
    }

    /**
     * Supprimer une inscription.
     */
    public function destroy(string $id)
    {
        $registration = Registration::findOrFail($id);

        $registration->delete();

        return redirect()
            ->route('registrations.index')
            ->with('success', 'Inscription supprimée avec succès.');
    }
}
