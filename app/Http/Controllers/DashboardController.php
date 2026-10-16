<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Formation;
use App\Models\Teacher;
use App\Models\Registration;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Utilisateur actuellement connecté
        $user = auth()->user();

        // Nombre total d'étudiants
        $nombreEtudiants = Student::count();

        // Nombre total de formations
        $nombreFormations = Formation::count();

        // Nombre de formations actives
        $nombreFormationsActives = Formation::whereRaw(
            'LOWER(statut) = ?',
            ['active']
        )->count();

        // Nombre total de formateurs
        $nombreFormateurs = Teacher::count();

        // Nombre total d'inscriptions
        $nombreInscriptions = Registration::count();

        // Nombre d'inscriptions actives
        $nombreInscriptionsActives = Registration::whereRaw(
            "LOWER(TRIM(statut)) = ?",
            ['active']
        )->count();

        // Nombre d'inscriptions terminées
        $nombreInscriptionsTerminees = Registration::whereRaw(
            "LOWER(TRIM(statut)) IN (?, ?, ?)",
            ['terminee', 'terminée', 'termine']
        )->count();

        // Les cinq inscriptions les plus récentes
        $dernieresInscriptions = Registration::with([
            'student',
            'formation',
        ])
            ->orderByDesc('date_inscription')
            ->take(5)
            ->get();

        // Transmettre les données à la vue
        return view('dashboard', compact(
            'user',
            'nombreEtudiants',
            'nombreFormations',
            'nombreFormationsActives',
            'nombreFormateurs',
            'nombreInscriptions',
            'nombreInscriptionsActives',
            'nombreInscriptionsTerminees',
            'dernieresInscriptions'
        ));
    }
}