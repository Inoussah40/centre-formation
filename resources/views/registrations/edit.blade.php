@extends('layouts.app')

@section('title', 'Modifier une inscription')

@section('content')

    <div class="mb-4">
        <a href="{{ route('registrations.index') }}"
           class="btn btn-outline-secondary btn-sm mb-3">
            ← Retour à la liste
        </a>

        <h1 class="mb-1">Modifier une inscription</h1>

        <p class="text-secondary mb-0">
            Modifiez les informations de cette inscription.
        </p>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-lg-8 col-xl-7">

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h2 class="h5 mb-0">Informations de l'inscription</h2>
                </div>

                <div class="card-body p-4">

                    <form action="{{ route('registrations.update', $registration->id) }}"
                          method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="student_id" class="form-label">
                                Étudiant
                            </label>

                            <select
                                name="student_id"
                                id="student_id"
                                class="form-select @error('student_id') is-invalid @enderror"
                                required
                            >
                                <option value="">-- Choisir un étudiant --</option>

                                @foreach ($students as $student)
                                    <option
                                        value="{{ $student->id }}"
                                        @selected((string) old('student_id', $registration->student_id) === (string) $student->id)
                                    >
                                        {{ $student->prenom }} {{ $student->nom }}
                                    </option>
                                @endforeach
                            </select>

                            @error('student_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="formation_id" class="form-label">
                                Formation
                            </label>

                            <select
                                name="formation_id"
                                id="formation_id"
                                class="form-select @error('formation_id') is-invalid @enderror"
                                required
                            >
                                <option value="">-- Choisir une formation --</option>

                                @foreach ($formations as $formation)
                                    <option
                                        value="{{ $formation->id }}"
                                        @selected((string) old('formation_id', $registration->formation_id) === (string) $formation->id)
                                    >
                                        {{ $formation->nom }}
                                    </option>
                                @endforeach
                            </select>

                            @error('formation_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="date_inscription" class="form-label">
                                Date d'inscription
                            </label>

                            <input
                                type="date"
                                name="date_inscription"
                                id="date_inscription"
                                class="form-control @error('date_inscription') is-invalid @enderror"
                                value="{{ old('date_inscription', $registration->date_inscription ? \Illuminate\Support\Carbon::parse($registration->date_inscription)->format('Y-m-d') : '') }}"
                                required
                            >

                            @error('date_inscription')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="statut" class="form-label">
                                Statut de l'inscription
                            </label>

                            <select
                                name="statut"
                                id="statut"
                                class="form-select @error('statut') is-invalid @enderror"
                                required
                            >
                                <option value="active"
                                    @selected(old('statut', $registration->statut) === 'active')>
                                    Active
                                </option>

                                <option value="terminée"
                                    @selected(old('statut', $registration->statut) === 'terminée')>
                                    Terminée
                                </option>
                            </select>

                            @error('statut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            <button type="submit" class="btn btn-primary">
                                Enregistrer les modifications
                            </button>

                            <a href="{{ route('registrations.index') }}"
                               class="btn btn-outline-secondary">
                                Annuler
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

@endsection