<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{
    /**
     * Afficher les formateurs avec recherche et pagination.
     */
    public function index(Request $request)
    {
        $search = trim((string) $request->input('search', ''));

        $teachers = Teacher::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('nom', 'like', "%{$search}%")
                        ->orWhere('prenom', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('specialite', 'like', "%{$search}%");
                });
            })
            ->orderBy('nom')
            ->paginate(10)
            ->withQueryString();

        return view('teachers.index', compact('teachers', 'search'));
    }

    /**
     * Afficher le formulaire de création.
     */
    public function create()
    {
        return view('teachers.create');
    }

    /**
     * Enregistrer un nouveau formateur.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email',
            'telephone' => 'required|string|max:20',
            'specialite' => 'required|string|max:255',
        ]);

        Teacher::create($validated);

        return redirect()->route('teachers.index')
            ->with('success', 'Formateur ajouté avec succès.');
    }

    /**
     * Afficher les détails d'un formateur.
     */
    public function show(string $id)
    {
        $teacher = Teacher::findOrFail($id);

        $formations = $teacher->formations;

        return view('teachers.show', compact('teacher', 'formations'));
    }

    /**
     * Afficher le formulaire de modification.
     */
    public function edit(string $id)
    {
        $teacher = Teacher::findOrFail($id);

        return view('teachers.edit', compact('teacher'));
    }

    /**
     * Modifier un formateur.
     */
    public function update(Request $request, string $id)
    {
        $teacher = Teacher::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email,' . $id,
            'telephone' => 'required|string|max:20',
            'specialite' => 'required|string|max:255',
        ]);

        $teacher->update($validated);

        return redirect()->route('teachers.index')
            ->with('success', 'Formateur modifié avec succès.');
    }

    /**
     * Supprimer un formateur.
     */
    public function destroy(string $id)
    {
        $teacher = Teacher::findOrFail($id);

        $teacher->delete();

        return redirect()->route('teachers.index')
            ->with('success', 'Formateur supprimé avec succès.');
    }
}