@extends('layouts.app')

@section('title', 'Modifier un formateur')

@section('content')

    <div class="mb-4">
        <a href="{{ route('teachers.index') }}"
           class="btn btn-outline-secondary btn-sm mb-3">
            ← Retour à la liste
        </a>

        <h1 class="mb-1">Modifier un formateur</h1>
        <p class="text-secondary mb-0">
            Modifiez les informations de {{ $teacher->prenom }} {{ $teacher->nom }}.
        </p>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-lg-8 col-xl-7">

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h2 class="h5 mb-0">Informations du formateur</h2>
                </div>

                <div class="card-body p-4">

                    <form action="{{ route('teachers.update', $teacher->id) }}"
                          method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>

                            <input
                                type="text"
                                name="nom"
                                id="nom"
                                class="form-control @error('nom') is-invalid @enderror"
                                value="{{ old('nom', $teacher->nom) }}"
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
                                value="{{ old('prenom', $teacher->prenom) }}"
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
                                value="{{ old('email', $teacher->email) }}"
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
                                value="{{ old('telephone', $teacher->telephone) }}"
                                required
                            >

                            @error('telephone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="specialite" class="form-label">Spécialité</label>

                            <input
                                type="text"
                                name="specialite"
                                id="specialite"
                                class="form-control @error('specialite') is-invalid @enderror"
                                value="{{ old('specialite', $teacher->specialite) }}"
                                placeholder="Ex. Développement web"
                                required
                            >

                            @error('specialite')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            <button type="submit" class="btn btn-primary">
                                Enregistrer les modifications
                            </button>

                            <a href="{{ route('teachers.index') }}"
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