@extends('layouts.app')

@section('title', 'Admin - Statistics')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-lg-2">
            @include('admin.sidebar')
        </div>

        <main class="col-md-9 col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">
                    <i class="fas fa-chart-line me-2 text-primary"></i>Statistiques
                </h1>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="stats-icon bg-primary">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="ms-3">
                                    <h5 class="card-title mb-0">Utilisateurs Total</h5>
                                    <p class="card-text display-6 mb-0">{{ $totalUsers }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="stats-icon bg-success">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                <div class="ms-3">
                                    <h5 class="card-title mb-0">Réservations Total</h5>
                                    <p class="card-text display-6 mb-0">{{ $totalReservations }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm mt-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-bar me-2 text-primary"></i>Réservations par Type de Repas
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="mealChart" height="200"></canvas>
                </div>
            </div>
        </main>
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

.bg-primary {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark)) !important;
}

.card {
    transition: transform 0.2s;
}

.card:hover {
    transform: translateY(-5px);
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('mealChart').getContext('2d');
    const mealChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Petit-déjeuner', 'Déjeuner', 'Dîner'],
            datasets: [{
                label: 'Nombre de Réservations',
                data: [
                    {{ $reservationsByType['petit_dejeuner'] }},
                    {{ $reservationsByType['dejeuner'] }},
                    {{ $reservationsByType['diner'] }}
                ],
                backgroundColor: [
                    'rgba(255, 215, 0, 0.7)',
                    'rgba(218, 165, 32, 0.7)',
                    'rgba(184, 134, 11, 0.7)'
                ],
                borderColor: [
                    'rgba(255, 215, 0, 1)',
                    'rgba(218, 165, 32, 1)',
                    'rgba(184, 134, 11, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: true,
                        drawBorder: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>
@endpush
@endsection
