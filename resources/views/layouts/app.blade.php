<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Centre de formation') | Gestion</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        :root {
            --primary-color: #174ea6;
            --dark-color: #14213d;
            --page-background: #f4f7fb;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: var(--page-background);
            color: #212529;
            font-family: Arial, Helvetica, sans-serif;
        }

        /* Barre de navigation */
        .navbar {
            background: linear-gradient(110deg, #174ea6, #2463c5);
        }

        .navbar-brand {
            font-size: 1.15rem;
            font-weight: 700;
            letter-spacing: 0.2px;
        }

        .navbar .nav-link {
            padding: 0.65rem 0.8rem;
            margin: 0.1rem;
            border-radius: 7px;
            transition: background-color 0.2s ease;
        }

        .navbar .nav-link:hover,
        .navbar .nav-link.active {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.16);
        }

        .navbar .btn {
            border-radius: 7px;
        }

        /* Contenu principal */
        main {
            flex: 1;
            width: 100%;
        }

        .page-container {
            background-color: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 15px rgba(20, 33, 61, 0.05);
        }

        h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 1.25rem;
            color: var(--dark-color);
        }

        h2 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-top: 1.5rem;
            margin-bottom: 1rem;
        }

        .table {
            vertical-align: middle;
        }

        .btn {
            border-radius: 7px;
        }

        /* Pied de page */
        .site-footer {
            margin-top: 1.5rem;
            background-color: var(--dark-color);
            color: #d8e0ed;
        }

        .footer-title {
            color: #fff;
            font-weight: 700;
            margin-bottom: 0.75rem;
        }

        .footer-text {
            color: #c1cce0;
            font-size: 0.9rem;
            line-height: 1.8;
        }

        .footer-link {
            display: inline-block;
            color: #d8e0ed;
            text-decoration: none;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            transition: color 0.2s ease;
        }

        .footer-link:hover {
            color: #fff;
            text-decoration: underline;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            color: #c1cce0;
            font-size: 0.85rem;
            line-height: 1.8;
        }

        .footer-bottom p {
            margin-bottom: 0;
            letter-spacing: 0.2px;
        }

        .footer-brand {
            color: #fff;
            font-weight: 700;
        }

        /* Affichage sur téléphone */
        @media (max-width: 576px) {
            .page-container {
                padding: 16px;
                border-radius: 8px;
            }

            h1 {
                font-size: 1.5rem;
            }

            .main-container {
                padding-left: 12px !important;
                padding-right: 12px !important;
            }

            .footer-bottom {
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
        <div class="container-fluid px-lg-4">

            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <span class="me-2">🎓</span> Centre de formation
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#menuPrincipal"
                aria-controls="menuPrincipal"
                aria-expanded="false"
                aria-label="Afficher le menu"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menuPrincipal">

                <ul class="navbar-nav me-auto my-2 my-lg-0">

                    <li class="nav-item">
                        <a
                            class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                            href="{{ route('dashboard') }}"
                        >
                            Tableau de bord
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link {{ request()->routeIs('students.*') ? 'active' : '' }}"
                            href="{{ route('students.index') }}"
                        >
                            Étudiants
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link {{ request()->routeIs('formations.*') ? 'active' : '' }}"
                            href="{{ route('formations.index') }}"
                        >
                            Formations
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link {{ request()->routeIs('teachers.*') ? 'active' : '' }}"
                            href="{{ route('teachers.index') }}"
                        >
                            Formateurs
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link {{ request()->routeIs('registrations.*') ? 'active' : '' }}"
                            href="{{ route('registrations.index') }}"
                        >
                            Inscriptions
                        </a>
                    </li>

                </ul>

                <form action="{{ route('logout') }}" method="POST" class="d-flex">
                    @csrf

                    <button type="submit" class="btn btn-light btn-sm fw-semibold">
                        Se déconnecter
                    </button>
                </form>

            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="main-container container-fluid px-3 px-lg-4 py-4">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Fermer"
                ></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Une erreur est survenue :</strong>

                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Fermer"
                ></button>
            </div>
        @endif

        <div class="page-container">
            @yield('content')
        </div>

    </main>

    <!-- Pied de page -->
    <footer class="site-footer">

        <div class="container-fluid px-4 px-lg-5 py-4">
            <div class="row g-4">

                <div class="col-md-5">
                    <h2 class="footer-title h6 mt-0">
                        🎓 Centre de formation
                    </h2>

                    <p class="footer-text mb-0">
                        Une plateforme dédiée à la gestion des étudiants,
                        des formations, des formateurs et des inscriptions.
                    </p>
                </div>

                <div class="col-md-3">
                    <h2 class="footer-title h6 mt-0">
                        Navigation
                    </h2>

                    <div class="d-flex flex-column align-items-start">
                        <a class="footer-link" href="{{ route('dashboard') }}">
                            Tableau de bord
                        </a>

                        <a class="footer-link" href="{{ route('students.index') }}">
                            Étudiants
                        </a>

                        <a class="footer-link" href="{{ route('formations.index') }}">
                            Formations
                        </a>

                        <a class="footer-link" href="{{ route('teachers.index') }}">
                            Formateurs
                        </a>

                        <a class="footer-link" href="{{ route('registrations.index') }}">
                            Inscriptions
                        </a>
                    </div>
                </div>

                <div class="col-md-4">
                    <h2 class="footer-title h6 mt-0">
                        À propos
                    </h2>

                    <p class="footer-text mb-0">
                        Application de gestion développée avec Laravel
                        et Bootstrap pour faciliter le suivi des activités
                        du centre.
                    </p>
                </div>

            </div>
        </div>

        <!-- Copyright et technologies -->
        <div class="footer-bottom py-3">
            <div class="container-fluid px-4 px-lg-5">
                <div class="d-flex flex-column flex-md-row
                            justify-content-between align-items-center gap-2">

                     <p class="text-center text-md-start">
                         &copy; {{ date('Y') }} —
                          <span class="footer-brand">Centre de Formation</span>.
                         Tous droits réservés.
                     </p>

                    <p class="text-center">
                        Conçu avec
                        <span class="text-danger" aria-label="amour">&hearts;</span>
                        <span class="footer-brand">Laravel</span>
                        &amp;
                        <span class="footer-brand">Bootstrap</span>
                    </p>

                </div>
            </div>
        </div>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>