@extends('layouts.app')

@section('title', 'Gestion des étudiants')

@section('content')

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="mb-1">Gestion des étudiants</h1>
            <p class="text-secondary mb-0">
                Consultez et gérez les étudiants du centre de formation.
            </p>
        </div>

        <a href="{{ route('students.create') }}" class="btn btn-primary">
            + Ajouter un étudiant
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            {{-- Formulaire de recherche --}}
            <form action="{{ route('students.index') }}"
                  method="GET"
                  class="mb-4">

                <div class="row g-2">
                    <div class="col-12 col-md-8">
                        <input
                            type="search"
                            name="search"
                            class="form-control"
                            placeholder="Rechercher par nom, prénom ou e-mail..."
                            value="{{ $search ?? request('search', '') }}"
                            aria-label="Rechercher un étudiant"
                        >
                    </div>

                    <div class="col-6 col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            Rechercher
                        </button>
                    </div>

                    <div class="col-6 col-md-2">
                        <a href="{{ route('students.index') }}"
                           class="btn btn-outline-secondary w-100">
                            Effacer
                        </a>
                    </div>
                </div>
            </form>

            {{-- Résultat de recherche --}}
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                <div>
                    <h2 class="h5 mb-1">Liste des étudiants</h2>

                    @if (!empty($search))
                        <p class="text-secondary small mb-0">
                            Recherche : « {{ $search }} »
                        </p>
                    @endif
                </div>

                <span class="badge text-bg-primary">
                    {{ $students->total() }} étudiant(s) trouvé(s)
                </span>
            </div>

            {{-- Tableau des étudiants --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>E-mail</th>
                            <th>Téléphone</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($students as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td class="fw-semibold">{{ $student->nom }}</td>
                                <td>{{ $student->prenom }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->telephone }}</td>

                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a
                                            href="{{ route('students.edit', $student->id) }}"
                                            class="btn btn-sm btn-outline-primary"
                                        >
                                            Modifier
                                        </a>

                                        @if (auth()->user()->role === 'admin')
                                            <form
                                                action="{{ route('students.destroy', $student->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Voulez-vous vraiment supprimer cet étudiant ?');"
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
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <p class="text-secondary mb-2">
                                        Aucun étudiant trouvé.
                                    </p>

                                    @if (!empty($search))
                                        <a
                                            href="{{ route('students.index') }}"
                                            class="btn btn-sm btn-outline-primary"
                                        >
                                            Afficher tous les étudiants
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($students->hasPages())
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mt-3">
                    <span class="text-secondary small">
                        Affichage de {{ $students->firstItem() }}
                        à {{ $students->lastItem() }}
                        sur {{ $students->total() }} étudiant(s)
                    </span>

                    <div>
                        {{ $students->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            @endif

        </div>
    </div>

@endsection