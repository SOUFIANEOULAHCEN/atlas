<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                   href="{{ route('admin.dashboard') }}">
                   <i class="fas fa-tachometer-alt me-2"></i> Tableau de bord
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->routeIs('admin.users*') ? 'active' : '' }}"
                   href="{{ route('admin.users.index') }}">
                   <i class="fas fa-users me-2"></i> Gestion des utilisateurs
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->routeIs('admin.reservations*') ? 'active' : '' }}"
                   href="{{ route('admin.reservations') }}">
                   <i class="fas fa-calendar-check me-2"></i> Gestion des réservations
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->routeIs('admin.statistics') ? 'active' : '' }}"
                   href="{{ route('admin.statistics') }}">
                   <i class="fas fa-chart-bar me-2"></i> Statistiques
                </a>
            </li>
            <li class="nav-item mt-3">
                <a class="nav-link text-white" href="{{ route('profile.show') }}">
                   <i class="fas fa-user-circle me-2"></i> Mon profil
                </a>
            </li>
        </ul>
    </div>
</nav>
