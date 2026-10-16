<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Teacher;

class FormationController extends Controller
{
    /**
     * Afficher les formations avec recherche et pagination.
     */
    public function index(Request $request)
    {
        $search = trim((string) $request->input('search', ''));

        $formations = Formation::with('teacher')
            ->when($search !== '', function ($query) use ($search) {
                $query->where('nom', 'like', "%{$search}%");
            })
            ->orderBy('nom')
            ->paginate(10)
            ->withQueryString();

        return view('formations.index', compact('formations', 'search'));
    }

    /**
     * Afficher le formulaire d'ajout.
     */
    public function create()
    {
        $teachers = Teacher::all();

        return view('formations.create', compact('teachers'));
    }

    /**
     * Enregistrer une nouvelle formation.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'duree' => 'required|integer|min:1',
            'prix' => 'required|numeric|min:0',
            'statut' => 'required|string',
            'teacher_id' => 'nullable|exists:teachers,id',
        ]);

        Formation::create($validated);

        return redirect()->route('formations.index')
            ->with('success', 'Formation ajoutée avec succès.');
    }

    /**
     * Afficher les détails d'une formation.
     */
    public function show(string $id)
    {
        $formation = Formation::with('teacher')->findOrFail($id);

        $teacher = $formation->teacher;

        return view('formations.show', compact('formation', 'teacher'));
    }

    /**
     * Afficher le formulaire de modification.
     */
    public function edit(string $id)
    {
        $formation = Formation::findOrFail($id);
        $teachers = Teacher::all();

        return view('formations.edit', compact('formation', 'teachers'));
    }

    /**
     * Modifier une formation.
     */
    public function update(Request $request, string $id)
    {
        $formation = Formation::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'duree' => 'required|integer|min:1',
            'prix' => 'required|numeric|min:0',
            'statut' => 'required|string',
            'teacher_id' => 'nullable|exists:teachers,id',
        ]);

        $formation->update($validated);

        return redirect()->route('formations.index')
            ->with('success', 'Formation modifiée avec succès.');
    }

    /**
     * Supprimer une formation.
     */
    public function destroy(string $id)
    {
        $formation = Formation::findOrFail($id);

        $formation->delete();

        return redirect()->route('formations.index')
            ->with('success', 'Formation supprimée avec succès.');
    }
}