@extends('layouts.app')

@section('title', 'Ajouter un étudiant')

@section('content')

    <div class="mb-4">
        <a href="{{ route('students.index') }}"
           class="btn btn-outline-secondary btn-sm mb-3">
            ← Retour à la liste
        </a>

        <h1 class="mb-1">Ajouter un étudiant</h1>
        <p class="text-secondary">
            Remplissez les informations pour enregistrer un nouvel étudiant.
        </p>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-lg-8 col-xl-7">

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h2 class="h5 mb-0">Informations de l'étudiant</h2>
                </div>

                <div class="card-body p-4">

                    <form action="{{ route('students.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input
                                type="text"
                                name="nom"
                                id="nom"
                                class="form-control @error('nom') is-invalid @enderror"
                                value="{{ old('nom') }}"
                                placeholder="Ex. : SIA"
                                required
                            >

                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input
                                type="text"
                                name="prenom"
                                id="prenom"
                                class="form-control @error('prenom') is-invalid @enderror"
                                value="{{ old('prenom') }}"
                                placeholder="Ex. : Inoussa"
                                required
                            >

                            @error('prenom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse e-mail</label>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                                placeholder="exemple@email.com"
                                required
                            >

                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="telephone" class="form-label">Téléphone</label>
                            <input
                                type="text"
                                name="telephone"
                                id="telephone"
                                class="form-control @error('telephone') is-invalid @enderror"
                                value="{{ old('telephone') }}"
                                placeholder="Ex. : 70123456"
                                required
                            >

                            @error('telephone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="date_naissance" class="form-label">
                                Date de naissance
                            </label>
                            <input
                                type="date"
                                name="date_naissance"
                                id="date_naissance"
                                class="form-control @error('date_naissance') is-invalid @enderror"
                                value="{{ old('date_naissance') }}"
                            >

                            @error('date_naissance')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="adresse" class="form-label">Adresse</label>
                            <textarea
                                name="adresse"
                                id="adresse"
                                rows="3"
                                class="form-control @error('adresse') is-invalid @enderror"
                                placeholder="Ville, secteur ou quartier"
                            >{{ old('adresse') }}</textarea>

                            @error('adresse')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            <button type="submit" class="btn btn-primary">
                                Enregistrer l'étudiant
                            </button>

                            <a href="{{ route('students.index') }}"
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
