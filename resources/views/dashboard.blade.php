
@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')

<style>
    .dashboard-header {
        background: linear-gradient(120deg, #174ea6, #3979d8);
        color: #fff;
        padding: 28px;
        border-radius: 16px;
        margin-bottom: 28px;
    }

    .dashboard-header h1 {
        color: #fff;
        margin-bottom: 8px;
    }

    .dashboard-header p {
        color: rgba(255, 255, 255, 0.85);
    }

    .stat-card {
        border: 0;
        border-radius: 14px;
        box-shadow: 0 4px 15px rgba(20, 33, 61, 0.06);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 22px rgba(20, 33, 61, 0.12);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 23px;
        flex-shrink: 0;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 750;
        line-height: 1.2;
        margin: 14px 0 8px;
    }

    .dashboard-section {
        border: 0;
        border-radius: 14px;
        box-shadow: 0 4px 15px rgba(20, 33, 61, 0.05);
        overflow: hidden;
    }

    .section-heading {
        font-size: 1.15rem;
        font-weight: 700;
        color: #14213d;
    }

    .quick-link {
        display: block;
        color: inherit;
        text-decoration: none;
        border: 1px solid #e8edf4;
        border-radius: 13px;
        background: #fff;
        height: 100%;
        transition: all 0.2s ease;
    }

    .quick-link:hover {
        transform: translateY(-3px);
        border-color: #b9cef3;
        box-shadow: 0 6px 18px rgba(20, 33, 61, 0.08);
    }

    .quick-icon {
        font-size: 25px;
        margin-bottom: 12px;
    }

    .dashboard-table th {
        font-size: 0.83rem;
        font-weight: 700;
        color: #526078;
        white-space: nowrap;
    }

    .dashboard-table td {
        font-size: 0.92rem;
    }

    @media (max-width: 576px) {
        .dashboard-header {
            padding: 20px;
        }

        .stat-number {
            font-size: 1.7rem;
        }
    }
</style>

<!-- En-tête -->
<div class="dashboard-header d-flex flex-wrap justify-content-between
            align-items-center gap-3">

    <div>
        <div class="small mb-2">
            ESPACE DE GESTION
        </div>

        <h1>Tableau de bord</h1>

        <p class="mb-0">
            Bienvenue {{ $user->name }} !
            Retrouvez ici les indicateurs de votre centre de formation.
        </p>
    </div>

    <div>
        <span class="badge rounded-pill bg-light text-primary px-3 py-2">
            {{ ucfirst($user->role) }}
        </span>
    </div>
</div>

<!-- Statistiques générales -->
<div class="d-flex flex-wrap justify-content-between
            align-items-center gap-2 mb-3">

    <div>
        <h2 class="section-heading mt-0 mb-1">Vue d'ensemble</h2>
        <p class="text-secondary small mb-0">
            Les principaux chiffres de votre centre.
        </p>
    </div>

    <span class="text-secondary small">
        Mis à jour à l'ouverture de la page
    </span>
</div>

<div class="row g-3 mb-4">

    <div class="col-12 col-sm-6 col-xl-3">
        <a href="{{ route('students.index') }}"
           class="card stat-card h-100 text-decoration-none text-reset">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-secondary fw-semibold">Étudiants</span>
                    <div class="stat-icon bg-primary-subtle">👨‍🎓</div>
                </div>

                <div class="stat-number text-primary">
                    {{ $nombreEtudiants }}
                </div>

                <div class="small text-secondary">
                    Étudiants enregistrés
                </div>
            </div>
            <div class="progress rounded-0" style="height: 4px;">
                <div class="progress-bar bg-primary w-100"></div>
            </div>
        </a>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <a href="{{ route('formations.index') }}"
           class="card stat-card h-100 text-decoration-none text-reset">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-secondary fw-semibold">Formations</span>
                    <div class="stat-icon bg-success-subtle">📚</div>
                </div>

                <div class="stat-number text-success">
                    {{ $nombreFormations }}
                </div>

                <div class="small text-secondary">
                    {{ $nombreFormationsActives }} formation(s) active(s)
                </div>
            </div>
            <div class="progress rounded-0" style="height: 4px;">
                <div class="progress-bar bg-success w-100"></div>
            </div>
        </a>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <a href="{{ route('teachers.index') }}"
           class="card stat-card h-100 text-decoration-none text-reset">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-secondary fw-semibold">Formateurs</span>
                    <div class="stat-icon bg-info-subtle">🧑‍🏫</div>
                </div>

                <div class="stat-number text-info">
                    {{ $nombreFormateurs }}
                </div>

                <div class="small text-secondary">
                    Formateurs enregistrés
                </div>
            </div>
            <div class="progress rounded-0" style="height: 4px;">
                <div class="progress-bar bg-info w-100"></div>
            </div>
        </a>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <a href="{{ route('registrations.index') }}"
           class="card stat-card h-100 text-decoration-none text-reset">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-secondary fw-semibold">Inscriptions</span>
                    <div class="stat-icon bg-warning-subtle">📝</div>
                </div>

                <div class="stat-number text-warning-emphasis">
                    {{ $nombreInscriptions }}
                </div>

                <div class="small text-secondary">
                    {{ $nombreInscriptionsActives }} inscription(s) active(s)
                </div>
            </div>
            <div class="progress rounded-0" style="height: 4px;">
                <div class="progress-bar bg-warning w-100"></div>
            </div>
        </a>
    </div>

</div>

<!-- État des inscriptions -->
<div class="card dashboard-section mb-4">
    <div class="card-body p-4">
        <h2 class="section-heading mt-0 mb-1">
            État des inscriptions
        </h2>

        <p class="text-secondary small mb-4">
            Répartition selon le statut des inscriptions.
        </p>

        <div class="row g-3">
            <div class="col-12 col-md-6">
                <div class="p-3 rounded-3 bg-success-subtle h-100">
                    <div class="d-flex justify-content-between align-items-center gap-3">
                        <div>
                            <div class="text-secondary small">
                                Inscriptions actives
                            </div>
                            <div class="fs-3 fw-bold text-success">
                                {{ $nombreInscriptionsActives }}
                            </div>
                        </div>
                        <span class="fs-2">🟢</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="p-3 rounded-3 bg-secondary-subtle h-100">
                    <div class="d-flex justify-content-between align-items-center gap-3">
                        <div>
                            <div class="text-secondary small">
                                Inscriptions terminées
                            </div>
                            <div class="fs-3 fw-bold text-secondary">
                                {{ $nombreInscriptionsTerminees }}
                            </div>
                        </div>
                        <span class="fs-2">✅</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Dernières inscriptions -->
<div class="card dashboard-section mb-4">
    <div class="card-header bg-white border-0 px-4 pt-4 pb-2">
        <div class="d-flex flex-wrap justify-content-between
                    align-items-center gap-2">

            <div>
                <h2 class="section-heading mt-0 mb-1">
                    Dernières inscriptions
                </h2>
                <p class="text-secondary small mb-0">
                    Les inscriptions récemment enregistrées.
                </p>
            </div>

            <a href="{{ route('registrations.index') }}"
               class="btn btn-primary btn-sm">
                Toutes les inscriptions →
            </a>
        </div>
    </div>

    <div class="card-body p-0 mt-3">
        @if ($dernieresInscriptions->count() > 0)

            <div class="table-responsive">
                <table class="table table-hover dashboard-table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Étudiant</th>
                            <th>Formation</th>
                            <th>Date d'inscription</th>
                            <th>Statut</th>
                            <th class="text-end pe-4">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($dernieresInscriptions as $inscription)
                            <tr>
                                <td class="ps-4 text-secondary">
                                    #{{ $inscription->id }}
                                </td>

                                <td class="fw-semibold">
                                    @if ($inscription->student)
                                        {{ $inscription->student->prenom }}
                                        {{ $inscription->student->nom }}
                                    @else
                                        <span class="text-secondary">
                                            Étudiant introuvable
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    @if ($inscription->formation)
                                        {{ $inscription->formation->nom }}
                                    @else
                                        <span class="text-secondary">
                                            Formation introuvable
                                        </span>
                                    @endif
                                </td>

                                <td class="text-nowrap">
                                    {{ $inscription->date_inscription
                                        ? \Illuminate\Support\Carbon::parse($inscription->date_inscription)->format('d/m/Y')
                                        : '—' }}
                                </td>

                                <td>
                                    @php
                                        $statut = strtolower($inscription->statut ?? '');
                                    @endphp

                                    @if ($statut === 'active')
                                        <span class="badge text-bg-success">Active</span>
                                    @elseif (in_array($statut, ['terminee', 'terminée']))
                                        <span class="badge text-bg-secondary">Terminée</span>
                                    @else
                                        <span class="badge text-bg-warning">
                                            {{ ucfirst($inscription->statut ?? 'Non défini') }}
                                        </span>
                                    @endif
                                </td>

                                <td class="text-end pe-4">
                                    <a href="{{ route('registrations.show', $inscription->id) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        Voir
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        @else
            <div class="text-center py-5 px-3">
                <div class="fs-1 mb-2">📝</div>
                <h3 class="h6 fw-bold">Aucune inscription pour le moment</h3>
                <p class="text-secondary small mb-3">
                    Les nouvelles inscriptions apparaîtront ici.
                </p>
                <a href="{{ route('registrations.create') }}"
                   class="btn btn-primary btn-sm">
                    + Nouvelle inscription
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Accès rapide -->
<div class="mb-3">
    <h2 class="section-heading mt-0 mb-1">Accès rapide</h2>
    <p class="text-secondary small mb-0">
        Accédez directement aux différentes rubriques.
    </p>
</div>

<div class="row g-3">

    <div class="col-12 col-sm-6 col-xl-3">
        <a href="{{ route('students.index') }}" class="quick-link p-4">
            <div class="quick-icon">👨‍🎓</div>
            <h3 class="h6 fw-bold text-primary">Étudiants</h3>
            <p class="text-secondary small mb-0">
                Consulter et gérer les étudiants.
            </p>
        </a>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <a href="{{ route('formations.index') }}" class="quick-link p-4">
            <div class="quick-icon">📚</div>
            <h3 class="h6 fw-bold text-success">Formations</h3>
            <p class="text-secondary small mb-0">
                Consulter les formations proposées.
            </p>
        </a>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <a href="{{ route('teachers.index') }}" class="quick-link p-4">
            <div class="quick-icon">🧑‍🏫</div>
            <h3 class="h6 fw-bold text-info">Formateurs</h3>
            <p class="text-secondary small mb-0">
                Consulter les formateurs du centre.
            </p>
        </a>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <a href="{{ route('registrations.index') }}" class="quick-link p-4">
            <div class="quick-icon">📝</div>
            <h3 class="h6 fw-bold text-warning-emphasis">Inscriptions</h3>
            <p class="text-secondary small mb-0">
                Consulter et suivre les inscriptions.
            </p>
        </a>
    </div>

</div>

@endsection
