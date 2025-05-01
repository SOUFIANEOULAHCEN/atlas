@extends('layouts.app')

@section('title', 'Tableau de Bord Administrateur')

@section('content')
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">
                    <i class="fas fa-tachometer-alt me-2 text-primary"></i>Tableau de bord
                </h1>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row mb-4">
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">
                                <i class="fas fa-link me-2 text-primary"></i>Accès Rapides
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-3">
                                <a href="{{ route('admin.reservations') }}" class="btn btn-primary">
                                    <i class="fas fa-calendar-check me-2"></i>Voir toutes les réservations
                                </a>
                                <a href="{{ route('admin.statistics') }}" class="btn btn-primary">
                                    <i class="fas fa-chart-line me-2"></i>Voir les statistiques
                                </a>
                                <a href="{{ route('admin.users.index') }}" class="btn btn-primary">
                                    <i class="fas fa-users me-2"></i>Gérer les utilisateurs
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="stats-icon bg-primary">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="card-subtitle text-muted mb-1">Utilisateurs Total</h6>
                                    <h2 class="card-title mb-0">{{ $totalUsers }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="stats-icon bg-success">
                                    <i class="fas fa-calendar-day"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="card-subtitle text-muted mb-1">Réservations Aujourd'hui</h6>
                                    <h2 class="card-title mb-0">{{ $todayReservations }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="stats-icon" style="background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="card-subtitle text-muted mb-1">Réservations ce Mois</h6>
                                    <h2 class="card-title mb-0">{{ $monthReservations }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.stats-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.stats-icon i {
    font-size: 24px;
    color: white;
}

.card {
    transition: transform 0.2s;
}

.card:hover {
    transform: translateY(-5px);
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    border: none;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 215, 0, 0.3);
}
</style>
@endpush
@endsection
