<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atlas Restaurant - @yield('title')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #FFD700;
            --primary-dark: #DAA520;
            --secondary-color: #333333;
            --accent-color: #FFB74D;
            --text-dark: #2C3E50;
            --text-light: #ECF0F1;
            --background-light: #F8F9FA;
            --background-dark: #2C3E50;
            --success-color: #2ECC71;
            --danger-color: #E74C3C;
        }

        body {
            background-color: var(--background-light);
            font-family: 'Poppins', sans-serif;
            color: var(--text-dark);
            padding-top: 76px;
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark)) !important;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            padding: 1rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1040;
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--text-dark) !important;
            font-size: 1.5rem;
        }

        .nav-link {
            color: var(--text-dark) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            border-radius: 8px;
            padding: 0.5rem 1rem !important;
        }

        .nav-link:hover {
            background-color: rgba(0, 0, 0, 0.1);
            transform: translateY(-1px);
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            overflow: hidden;
            background: white;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: var(--text-dark);
            font-weight: 600;
            border: none;
            padding: 1.25rem;
        }

        .btn {
            border-radius: 10px;
            padding: 0.6rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.9rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            border: none;
            color: var(--text-dark);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-color));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 215, 0, 0.3);
        }

        .btn-secondary {
            background-color: var(--secondary-color);
            border: none;
        }

        .table {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
        }

        .table thead {
            background-color: var(--primary-color);
            color: var(--text-dark);
        }

        .table th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #eee;
            padding: 0.75rem 1.2rem;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(255, 215, 0, 0.25);
        }

        .badge {
            padding: 0.5em 1em;
            border-radius: 8px;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .alert {
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            padding: 1rem 1.5rem;
        }

        #sidebar {
            background-color: var(--background-dark);
            min-height: calc(100vh - 56px);
            padding-top: 2rem;
        }

        #sidebar .nav-link {
            color: var(--text-light) !important;
            margin: 0.5rem 1rem;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        #sidebar .nav-link:hover, #sidebar .nav-link.active {
            background-color: var(--primary-color);
            color: var(--text-dark) !important;
            transform: translateX(5px);
        }

        .user-dropdown img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border: 2px solid white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        footer {
            background-color: var(--background-dark);
            color: var(--text-light);
            padding: 3rem 0;
            margin-top: 4rem;
        }

        /* Modern Animations */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }

        @media (max-width: 768px) {
            main {
                margin-left: 0 !important;
                padding-top: 1rem;
            }

            .navbar {
                z-index: 1050;
            }

            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }
    </style>
    @stack('styles')
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" width="45" height="45" class="me-2">
                Atlas Restaurant
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    @auth
                        <li class="nav-item dropdown user-dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <img src="{{ asset(Auth::user()->photo ? 'storage/'.Auth::user()->photo : 'images/default-profile.png') }}"
                                     alt="Profile" class="rounded-circle me-2">
                                {{ Auth::user()->Prenom }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ Auth::user()->TypeCompte === 'admin' ? route('admin.dashboard') : route('user.dashboard') }}">
                                        <i class="fas fa-tachometer-alt me-2"></i> Tableau de bord
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.show') }}">
                                        <i class="fas fa-user-circle me-2"></i> Mon profil
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i> Connexion
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-user-plus me-1"></i> Inscription
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    @auth
        @if(Auth::user()->TypeCompte === 'admin')
            @include('admin.sidebar')
        @endif
    @endauth

    <!-- Main Content -->
    <main class="py-4 fade-in" style="margin-left: {{ Auth::check() && Auth::user()->TypeCompte === 'admin' ? '280px' : '0' }}; margin-top: 76px;">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>



    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('scripts')

    <!-- Animation Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.body.classList.add('fade-in');
        });
    </script>
</body>
</html>
