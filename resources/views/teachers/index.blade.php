@extends('layouts.app')

@section('title', 'Gestion des formateurs')

@section('content')

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="mb-1">Gestion des formateurs</h1>
            <p class="text-secondary mb-0">
                Consultez et gérez les formateurs du centre de formation.
            </p>
        </div>

        <a href="{{ route('teachers.create') }}" class="btn btn-primary">
            + Ajouter un formateur
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            {{-- Formulaire de recherche --}}
            <form action="{{ route('teachers.index') }}" method="GET" class="mb-4">
                <div class="row g-2">
                    <div class="col-12 col-md-8">
                        <input
                            type="search"
                            name="search"
                            class="form-control"
                            placeholder="Rechercher par nom, prénom, e-mail ou spécialité..."
                            value="{{ $search ?? request('search', '') }}"
                            aria-label="Rechercher un formateur"
                        >
                    </div>

                    <div class="col-6 col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            Rechercher
                        </button>
                    </div>

                    <div class="col-6 col-md-2">
                        <a href="{{ route('teachers.index') }}"
                           class="btn btn-outline-secondary w-100">
                            Effacer
                        </a>
                    </div>
                </div>
            </form>

            {{-- Titre et résultats --}}
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                <div>
                    <h2 class="h5 mb-1">Liste des formateurs</h2>

                    @if (!empty($search))
                        <p class="text-secondary small mb-0">
                            Recherche : « {{ $search }} »
                        </p>
                    @endif
                </div>

                <span class="badge text-bg-primary">
                    {{ $teachers->total() }} formateur(s) trouvé(s)
                </span>
            </div>

            {{-- Tableau des formateurs --}}
            @if ($teachers->count() > 0)

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>E-mail</th>
                                <th>Téléphone</th>
                                <th>Spécialité</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($teachers as $teacher)
                                <tr>
                                    <td>{{ $teacher->id }}</td>
                                    <td class="fw-semibold">{{ $teacher->nom }}</td>
                                    <td>{{ $teacher->prenom }}</td>
                                    <td>{{ $teacher->email }}</td>
                                    <td>{{ $teacher->telephone }}</td>
                                    <td>{{ $teacher->specialite }}</td>

                                    <td class="text-end text-nowrap">
                                        <a
                                            href="{{ route('teachers.edit', $teacher->id) }}"
                                            class="btn btn-sm btn-outline-primary"
                                        >
                                            Modifier
                                        </a>

                                        <form
                                            action="{{ route('teachers.destroy', $teacher->id) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Voulez-vous vraiment supprimer ce formateur ?')"
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
                @if ($teachers->hasPages())
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mt-4">
                        <span class="text-secondary small">
                            Affichage de {{ $teachers->firstItem() }}
                            à {{ $teachers->lastItem() }}
                            sur {{ $teachers->total() }} formateur(s)
                        </span>

                        {{ $teachers->links('pagination::bootstrap-5') }}
                    </div>
                @endif

            @else
                <div class="text-center py-5 px-3">
                    <h3 class="h5">Aucun formateur trouvé</h3>

                    <p class="text-secondary">
                        @if (!empty($search))
                            Aucun formateur ne correspond à « {{ $search }} ».
                        @else
                            Ajoutez votre premier formateur pour commencer.
                        @endif
                    </p>

                    @if (!empty($search))
                        <a href="{{ route('teachers.index') }}"
                           class="btn btn-outline-primary">
                            Afficher tous les formateurs
                        </a>
                    @else
                        <a href="{{ route('teachers.create') }}"
                           class="btn btn-primary">
                            Ajouter un formateur
                        </a>
                    @endif
                </div>
            @endif

        </div>

        <div class="card-footer bg-white text-secondary small">
            Nombre de formateurs trouvés : {{ $teachers->total() }}
        </div>
    </div>

@endsection