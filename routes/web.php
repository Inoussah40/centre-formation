<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\DashboardController;

// Accueil : redirection vers la connexion
Route::get('/', function () {
    return redirect()->route('login');
});

// Pages accessibles uniquement aux visiteurs non connectés
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.submit');
});

// Toutes les pages suivantes nécessitent une authentification
Route::middleware('auth')->group(function () {

    // Déconnexion
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // Tableau de bord
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('role:admin,secretaire')
    ->name('dashboard');

    // Étudiants
    Route::get('/students', [StudentController::class, 'index'])
        ->name('students.index');

    Route::get('/students/create', [StudentController::class, 'create'])
        ->name('students.create');

    Route::post('/students', [StudentController::class, 'store'])
        ->name('students.store');

    Route::get('/students/{id}/edit', [StudentController::class, 'edit'])
        ->name('students.edit');

    Route::put('/students/{id}', [StudentController::class, 'update'])
        ->name('students.update');

    Route::delete('/students/{id}', [StudentController::class, 'destroy'])
       ->middleware('role:admin')
       ->name('students.destroy');

    // Formations
    Route::get('/formations', [FormationController::class, 'index'])
        ->name('formations.index');

    Route::get('/formations/create', [FormationController::class, 'create'])
        ->name('formations.create');

    Route::post('/formations', [FormationController::class, 'store'])
        ->name('formations.store');

    Route::get('/formations/{id}/edit', [FormationController::class, 'edit'])
        ->name('formations.edit');

    Route::put('/formations/{id}', [FormationController::class, 'update'])
        ->name('formations.update');

    Route::delete('/formations/{id}', [FormationController::class, 'destroy'])
        ->name('formations.destroy');

    Route::get('/formations/{id}', [FormationController::class, 'show'])
        ->name('formations.show');

    // Formateurs
    Route::get('/teachers', [TeacherController::class, 'index'])
        ->name('teachers.index');

    Route::get('/teachers/create', [TeacherController::class, 'create'])
        ->name('teachers.create');

    Route::post('/teachers', [TeacherController::class, 'store'])
        ->name('teachers.store');

    Route::get('/teachers/{id}/edit', [TeacherController::class, 'edit'])
        ->name('teachers.edit');

    Route::put('/teachers/{id}', [TeacherController::class, 'update'])
        ->name('teachers.update');

    Route::delete('/teachers/{id}', [TeacherController::class, 'destroy'])
        ->name('teachers.destroy');

    Route::get('/teachers/{id}', [TeacherController::class, 'show'])
        ->name('teachers.show');

    // Inscriptions
    Route::get('/registrations', [RegistrationController::class, 'index'])
        ->name('registrations.index');

    Route::get('/registrations/create', [RegistrationController::class, 'create'])
        ->name('registrations.create');

    Route::post('/registrations', [RegistrationController::class, 'store'])
        ->name('registrations.store');

    Route::get('/registrations/{id}/edit', [RegistrationController::class, 'edit'])
        ->name('registrations.edit');

    Route::put('/registrations/{id}', [RegistrationController::class, 'update'])
        ->name('registrations.update');

    Route::delete('/registrations/{id}', [RegistrationController::class, 'destroy'])
        ->name('registrations.destroy');

    Route::get('/registrations/{id}', [RegistrationController::class, 'show'])
        ->name('registrations.show');
});
