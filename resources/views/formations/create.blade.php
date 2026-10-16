@extends('layouts.app')

@section('title', 'Ajouter une formation')

@section('content')

    <div class="mb-4">
        <a href="{{ route('formations.index') }}"
           class="btn btn-outline-secondary btn-sm mb-3">
            ← Retour à la liste
        </a>

        <h1 class="mb-1">Ajouter une formation</h1>
        <p class="text-secondary mb-0">
            Enregistrez une nouvelle formation dans le centre.
        </p>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-lg-8 col-xl-7">

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h2 class="h5 mb-0">Informations de la formation</h2>
                </div>

                <div class="card-body p-4">

                    <form action="{{ route('formations.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nom" class="form-label">
                                Nom de la formation
                            </label>

                            <input
                                type="text"
                                name="nom"
                                id="nom"
                                class="form-control @error('nom') is-invalid @enderror"
                                value="{{ old('nom') }}"
                                placeholder="Ex. Développement Web"
                                required
                            >

                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">
                                Description
                            </label>

                            <textarea
                                name="description"
                                id="description"
                                rows="4"
                                class="form-control @error('description') is-invalid @enderror"
                                placeholder="Décrivez le contenu de la formation..."
                            >{{ old('description') }}</textarea>

                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="duree" class="form-label">
                                    Durée
                                </label>

                                <input
                                    type="text"
                                    name="duree"
                                    id="duree"
                                    class="form-control @error('duree') is-invalid @enderror"
                                    value="{{ old('duree') }}"
                                    placeholder="Ex. 6 mois"
                                    required
                                >

                                @error('duree')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="prix" class="form-label">
                                    Prix
                                </label>

                                <div class="input-group">
                                    <input
                                        type="number"
                                        name="prix"
                                        id="prix"
                                        class="form-control @error('prix') is-invalid @enderror"
                                        value="{{ old('prix') }}"
                                        min="0"
                                        step="1"
                                        placeholder="Ex. 50000"
                                        required
                                    >
                                    <span class="input-group-text">FCFA</span>
                                </div>

                                @error('prix')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="statut" class="form-label">
                                Statut
                            </label>

                            <select
                                name="statut"
                                id="statut"
                                class="form-select @error('statut') is-invalid @enderror"
                                required
                            >
                                <option value="active" @selected(old('statut', 'active') === 'active')>
                                    Active
                                </option>

                                <option value="inactive" @selected(old('statut') === 'inactive')>
                                    Inactive
                                </option>
                            </select>

                            @error('statut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            <button type="submit" class="btn btn-primary">
                                Enregistrer la formation
                            </button>

                            <a href="{{ route('formations.index') }}"
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