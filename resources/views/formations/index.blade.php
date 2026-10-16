@extends('layouts.app')

@section('title', 'Gestion des formations')

@section('content')

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="mb-1">Gestion des formations</h1>
            <p class="text-secondary mb-0">
                Consultez et gérez les formations proposées par le centre.
            </p>
        </div>

        <a href="{{ route('formations.create') }}" class="btn btn-primary">
            + Ajouter une formation
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            {{-- Recherche --}}
            <form action="{{ route('formations.index') }}" method="GET" class="mb-4">
                <div class="row g-2">
                    <div class="col-12 col-md-8">
                        <input
                            type="search"
                            name="search"
                            class="form-control"
                            placeholder="Rechercher une formation par son nom..."
                            value="{{ $search ?? request('search', '') }}"
                            aria-label="Rechercher une formation"
                        >
                    </div>

                    <div class="col-6 col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            Rechercher
                        </button>
                    </div>

                    <div class="col-6 col-md-2">
                        <a href="{{ route('formations.index') }}"
                           class="btn btn-outline-secondary w-100">
                            Effacer
                        </a>
                    </div>
                </div>
            </form>

            {{-- Titre et nombre de résultats --}}
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                <div>
                    <h2 class="h5 mb-1">Liste des formations</h2>

                    @if (!empty($search))
                        <p class="text-secondary small mb-0">
                            Recherche : « {{ $search }} »
                        </p>
                    @endif
                </div>

                <span class="badge text-bg-primary">
                    {{ $formations->total() }} formation(s) trouvée(s)
                </span>
            </div>

            {{-- Tableau --}}
            @if ($formations->count() > 0)

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Durée</th>
                                <th>Prix</th>
                                <th>Formateur</th>
                                <th>Statut</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($formations as $formation)
                                <tr>
                                    <td>{{ $formation->id }}</td>

                                    <td class="fw-semibold">
                                        {{ $formation->nom }}
                                    </td>

                                    <td>
                                        {{ $formation->description ?: 'Aucune description' }}
                                    </td>

                                    <td>{{ $formation->duree }}</td>

                                    <td class="text-nowrap">
                                        {{ number_format((float) $formation->prix, 0, ',', ' ') }}
                                    </td>

                                    <td>
                                        {{ $formation->teacher
                                            ? $formation->teacher->nom . ' ' . $formation->teacher->prenom
                                            : 'Non attribué' }}
                                    </td>

                                    <td>
                                        @if ($formation->statut === 'active')
                                            <span class="badge text-bg-success">Active</span>
                                        @else
                                            <span class="badge text-bg-secondary">Inactive</span>
                                        @endif
                                    </td>

                                    <td class="text-end text-nowrap">
                                        <a
                                            href="{{ route('formations.edit', $formation->id) }}"
                                            class="btn btn-sm btn-outline-primary"
                                        >
                                            Modifier
                                        </a>

                                        <form
                                            action="{{ route('formations.destroy', $formation->id) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Voulez-vous vraiment supprimer cette formation ?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                            >
                                                Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if ($formations->hasPages())
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mt-4">
                        <span class="text-secondary small">
                            Affichage de {{ $formations->firstItem() }}
                            à {{ $formations->lastItem() }}
                            sur {{ $formations->total() }} formation(s)
                        </span>

                        {{ $formations->links('pagination::bootstrap-5') }}
                    </div>
                @endif

            @else
                <div class="text-center py-5 px-3">
                    <h3 class="h5">Aucune formation trouvée</h3>

                    <p class="text-secondary">
                        @if (!empty($search))
                            Aucune formation ne correspond à « {{ $search }} ».
                        @else
                            Commencez par ajouter une formation au centre.
                        @endif
                    </p>

                    @if (!empty($search))
                        <a href="{{ route('formations.index') }}"
                           class="btn btn-outline-primary">
                            Afficher toutes les formations
                        </a>
                    @else
                        <a href="{{ route('formations.create') }}"
                           class="btn btn-primary">
                            Ajouter une formation
                        </a>
                    @endif
                </div>
            @endif

        </div>

        <div class="card-footer bg-white text-secondary small">
            Nombre de formations trouvées : {{ $formations->total() }}
        </div>
    </div>

@endsection