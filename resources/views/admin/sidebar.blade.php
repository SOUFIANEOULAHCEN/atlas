<div class="sidebar py-4" style="min-height: calc(100vh - 70px);">
    <div class="d-flex justify-content-between align-items-center px-4 mb-4 d-md-none">
        <h5 class="mb-0 text-white">Menu</h5>
        <button class="btn-close btn-close-white" id="closeSidebar"></button>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item mb-4">
            <div class="px-4">
                <div class="d-flex align-items-center">
                    <div class="profile-img-wrapper me-3">
                        <img src="{{ asset(Auth::user()->photo ?? 'images/default-profile.png') }}"
                             alt="Admin"
                             class="rounded-circle"
                             width="100" height="100">
                    </div>
                    <div>
                        <h6 class="mb-1 fw-bold">{{ Auth::user()->nom }} {{ Auth::user()->Prenom }}</h6>
                        <span class="admin-badge">Administrateur</span>
                    </div>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link d-flex align-items-center {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
               href="{{ route('admin.dashboard') }}">
               <i class="fas fa-tachometer-alt me-3"></i>
               <span>Tableau de bord</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link d-flex align-items-center {{ request()->routeIs('admin.reservations*') ? 'active' : '' }}"
               href="{{ route('admin.reservations') }}">
               <i class="fas fa-calendar-check me-3"></i>
               <span>Gestion des réservations</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link d-flex align-items-center {{ request()->routeIs('admin.statistics') ? 'active' : '' }}"
               href="{{ route('admin.statistics') }}">
               <i class="fas fa-chart-bar me-3"></i>
               <span>Statistiques</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link d-flex align-items-center {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
               href="{{ route('admin.users.index') }}">
               <i class="fas fa-users me-3"></i>
               <span>Gestion des utilisateurs</span>
            </a>
        </li>

        <div class="sidebar-footer">
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" href="{{ route('profile.show') }}">
                   <i class="fas fa-user-circle me-3"></i>
                   <span>Mon profil</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" href="#"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                   <i class="fas fa-sign-out-alt me-3"></i>
                   <span>Déconnexion</span>
                </a>
            </li>
        </div>
    </ul>
</div>

<style>
.sidebar {
    background: linear-gradient(to bottom, #2C3E50, #1a252f);
    position: fixed;
    top: 76px; /* hauteur de la navbar */
    left: 0;
    height: calc(100vh - 76px);
    width: 280px;
    z-index: 1020;
    overflow-y: auto;
    box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.profile-img-wrapper {
    position: relative;
    width: 100px;
    height: 100px;
    margin: 0 auto;
    border-radius: 50%;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.profile-img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border: 3px solid var(--primary-color);
}

.admin-badge {
    font-size: 0.8rem;
    color: var(--primary-color);
    font-weight: 500;
    background: rgba(255, 215, 0, 0.1);
    padding: 0.3rem 0.8rem;
    border-radius: 20px;
    display: inline-block;
    margin-top: 0.5rem;
}

.sidebar .nav-link {
    padding: 0.8rem 1.5rem;
    margin: 0.5rem 1rem;
    border-radius: 10px;
    color: #ECF0F1 !important;
    transition: all 0.3s ease;
    opacity: 0.8;
    font-size: 0.95rem;
    white-space: nowrap;
    display: flex;
    align-items: center;
}

.sidebar .nav-link i {
    width: 24px;
    margin-right: 10px;
    text-align: center;
}

.sidebar-footer {
    margin-top: auto;
    padding: 1rem;
    border-top: 1px solid rgba(255,255,255,0.1);
}

@media (max-width: 768px) {
    .sidebar {
        left: -280px;
    }

    .sidebar.show {
        left: 0;
    }
}
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.querySelector('.sidebar');
    const toggleButton = document.createElement('button');
    toggleButton.className = 'navbar-toggler d-md-none';
    toggleButton.innerHTML = '<span class="navbar-toggler-icon"></span>';
    document.querySelector('.navbar-brand').after(toggleButton);

    toggleButton.addEventListener('click', function() {
        sidebar.classList.toggle('show');
    });

    // Fermer le sidebar en cliquant en dehors
    document.addEventListener('click', function(event) {
        if (!sidebar.contains(event.target) && !toggleButton.contains(event.target)) {
            sidebar.classList.remove('show');
        }
    });

    // Animation des icônes au survol
    const navLinks = document.querySelectorAll('.sidebar .nav-link');
    navLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            const icon = this.querySelector('i');
            icon.style.transform = 'scale(1.1) rotate(5deg)';
        });

        link.addEventListener('mouseleave', function() {
            const icon = this.querySelector('i');
            icon.style.transform = 'scale(1) rotate(0)';
        });
    });

    // Fermer le sidebar avec le bouton de fermeture
    const closeSidebarButton = document.getElementById('closeSidebar');
    closeSidebarButton.addEventListener('click', function() {
        sidebar.classList.remove('show');
    });
});
</script>
@endpush
