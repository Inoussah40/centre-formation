<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Afficher la liste des étudiants avec recherche et pagination.
     */
    public function index(Request $request)
    {
        $search = trim((string) $request->input('search', ''));

        $students = Student::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('nom', 'like', "%{$search}%")
                        ->orWhere('prenom', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderBy('nom')
            ->paginate(10)
            ->withQueryString();

        return view('students.index', compact('students', 'search'));
    }

    /**
     * Afficher le formulaire d'ajout.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Enregistrer un nouvel étudiant.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'telephone' => 'required|string|max:20',
            'date_naissance' => 'required|date',
            'adresse' => 'required|string',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')
            ->with('success', 'Étudiant ajouté avec succès.');
    }

    /**
     * Afficher un étudiant.
     */
    public function show(string $id)
    {
        $student = Student::findOrFail($id);

        return view('students.show', compact('student'));
    }

    /**
     * Afficher le formulaire de modification.
     */
    public function edit(string $id)
    {
        $student = Student::findOrFail($id);

        return view('students.edit', compact('student'));
    }

    /**
     * Mettre à jour un étudiant.
     */
    public function update(Request $request, string $id)
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
            'telephone' => 'required|string|max:20',
            'date_naissance' => 'required|date',
            'adresse' => 'required|string',
        ]);

        $student->update($validated);

        return redirect()->route('students.index')
            ->with('success', 'Étudiant modifié avec succès.');
    }

    /**
     * Supprimer un étudiant.
     */
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);

        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Étudiant supprimé avec succès.');
    }
}
