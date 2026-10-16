
@extends('layouts.app')

@section('title', 'Gestion des inscriptions')

@section('content')

<div class="container-fluid px-0">

    {{-- En-tête --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="h2 fw-bold mb-2">Gestion des inscriptions</h1>
            <p class="text-secondary mb-0">
                Consultez et gérez les inscriptions des étudiants aux formations.
            </p>
        </div>

        <a href="{{ route('registrations.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i>
            Nouvelle inscription
        </a>
    </div>

    {{-- Message de succès --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Fermer"></button>
        </div>
    @endif

    {{-- Liste des inscriptions --}}
    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">

        <div class="card-header bg-white border-bottom py-3">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                <h2 class="h5 fw-bold mb-0">
                    <i class="bi bi-journal-check text-primary me-2"></i>
                    Liste des inscriptions
                </h2>

                <span class="badge rounded-pill text-bg-primary">
                    {{ $registrations->total() }} inscription(s)
                </span>
            </div>
        </div>

        {{-- Recherche --}}
        <div class="card-body border-bottom bg-light">
            <form action="{{ route('registrations.index') }}" method="GET">
                <div class="row g-2 align-items-center">

                    <div class="col-12 col-md-9">
                        <label for="search" class="visually-hidden">
                            Rechercher une inscription
                        </label>

                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i class="bi bi-search text-secondary"></i>
                            </span>

                            <input
                                type="search"
                                id="search"
                                name="search"
                                class="form-control"
                                placeholder="Étudiant, formation, date ou statut..."
                                value="{{ $search ?? request('search', '') }}"
                            >
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-grow-1">
                                Rechercher
                            </button>

                            <a href="{{ route('registrations.index') }}"
                               class="btn btn-outline-secondary">
                                Effacer
                            </a>
                        </div>
                    </div>

                </div>
            </form>
        </div>

        <div class="card-body p-0">

            @if ($registrations->count() > 0)

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">
                            <tr>
                                <th class="ps-3 py-3">ID</th>
                                <th>Étudiant</th>
                                <th>Formation</th>
                                <th>Date d'inscription</th>
                                <th>Statut</th>
                                <th class="text-end pe-3">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($registrations as $registration)
                                <tr>
                                    {{-- Identifiant --}}
                                    <td class="ps-3 fw-semibold text-secondary">
                                        #{{ $registration->id }}
                                    </td>

                                    {{-- Étudiant --}}
                                    <td>
                                        <div class="fw-semibold">
                                            {{ $registration->student->prenom ?? '' }}
                                            {{ $registration->student->nom ?? '' }}
                                        </div>

                                        @if (!$registration->student)
                                            <span class="text-danger small">
                                                Étudiant introuvable
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Formation --}}
                                    <td>
                                        {{ $registration->formation->nom ?? 'Formation introuvable' }}
                                    </td>

                                    {{-- Date --}}
                                    <td class="text-nowrap">
                                        @if ($registration->date_inscription)
                                            {{ \Illuminate\Support\Carbon::parse($registration->date_inscription)->format('d/m/Y') }}
                                        @else
                                            <span class="text-secondary">—</span>
                                        @endif
                                    </td>

                                    {{-- Statut --}}
                                    <td>
                                        @php
                                            $statut = mb_strtolower(trim($registration->statut ?? ''));
                                        @endphp

                                        @if ($statut === 'active')
                                            <span class="badge rounded-pill text-bg-success">
                                                <i class="bi bi-check-circle me-1"></i>
                                                Active
                                            </span>
                                        @elseif (in_array($statut, ['terminee', 'terminée'], true))
                                            <span class="badge rounded-pill text-bg-secondary">
                                                <i class="bi bi-check2-all me-1"></i>
                                                Terminée
                                            </span>
                                        @else
                                            <span class="badge rounded-pill text-bg-warning">
                                                {{ $registration->statut ?: 'Non défini' }}
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Actions --}}
                                    <td class="text-end pe-3">
                                        <div class="d-inline-flex flex-wrap justify-content-end gap-1">

                                            <a
                                                href="{{ route('registrations.show', $registration->id) }}"
                                                class="btn btn-sm btn-outline-info"
                                                title="Consulter"
                                                aria-label="Consulter l'inscription {{ $registration->id }}"
                                            >
                                                <i class="bi bi-eye"></i>
                                                <span class="d-none d-xl-inline">Voir</span>
                                            </a>

                                            <a
                                                href="{{ route('registrations.edit', $registration->id) }}"
                                                class="btn btn-sm btn-outline-primary"
                                                title="Modifier"
                                                aria-label="Modifier l'inscription {{ $registration->id }}"
                                            >
                                                <i class="bi bi-pencil-square"></i>
                                                <span class="d-none d-xl-inline">Modifier</span>
                                            </a>

                                            <form
                                                action="{{ route('registrations.destroy', $registration->id) }}"
                                                method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Voulez-vous vraiment supprimer cette inscription ? Cette action est définitive.')"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Supprimer"
                                                    aria-label="Supprimer l'inscription {{ $registration->id }}"
                                                >
                                                    <i class="bi bi-trash"></i>
                                                    <span class="d-none d-xl-inline">Supprimer</span>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

                {{-- Pagination --}}
                @if ($registrations->hasPages())
                    <div class="card-footer bg-white border-top p-3">
                        {{ $registrations->links('pagination::bootstrap-5') }}
                    </div>
                @endif

            @else

                {{-- Aucun résultat --}}
                <div class="text-center py-5 px-3">
                    <i class="bi bi-journal-x display-4 text-secondary"></i>

                    @if (!empty($search))
                        <h3 class="h5 fw-bold mt-3">
                            Aucune inscription trouvée
                        </h3>

                        <p class="text-secondary">
                            Aucune inscription ne correspond à votre recherche.
                        </p>

                        <a href="{{ route('registrations.index') }}"
                           class="btn btn-outline-primary">
                            <i class="bi bi-arrow-counterclockwise me-1"></i>
                            Afficher toutes les inscriptions
                        </a>
                    @else
                        <h3 class="h5 fw-bold mt-3">
                            Aucune inscription enregistrée
                        </h3>

                        <p class="text-secondary">
                            Créez une inscription pour commencer.
                        </p>

                        <a href="{{ route('registrations.create') }}"
                           class="btn btn-primary">
                            <i class="bi bi-plus-circle me-1"></i>
                            Nouvelle inscription
                        </a>
                    @endif
                </div>

            @endif

        </div>

        {{-- Pied du tableau --}}
        <div class="card-footer bg-white text-secondary small py-3">
            <i class="bi bi-info-circle me-1"></i>
            Inscriptions affichées sur cette page :
            <strong>{{ $registrations->count() }}</strong>
            sur <strong>{{ $registrations->total() }}</strong> au total.
        </div>

    </div>

</div>

@endsection