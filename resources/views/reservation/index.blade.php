@extends('layouts.app')

@section('title', 'Mes Réservations')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">
                    <i class="fas fa-calendar-alt me-2 text-primary"></i>Mes Réservations
                </h2>
                <a href="{{ route('reservations.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle me-2"></i>Nouvelle Réservation
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">
                                        <i class="fas fa-calendar-day me-2"></i>Date
                                    </th>
                                    <th>
                                        <i class="fas fa-sun me-2"></i>Petit-déjeuner
                                    </th>
                                    <th>
                                        <i class="fas fa-cloud-sun me-2"></i>Déjeuner
                                    </th>
                                    <th>
                                        <i class="fas fa-moon me-2"></i>Dîner
                                    </th>
                                    <th class="text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($reservations as $reservation)
                                <tr>
                                    <td class="ps-4 align-middle">
                                        {{ date('d/m/Y', strtotime($reservation->DateReservation)) }}
                                    </td>
                                    <td class="align-middle">
                                        <span class="badge {{ $reservation->Repas1 ? 'bg-success' : 'bg-secondary' }}">
                                            <i class="fas {{ $reservation->Repas1 ? 'fa-check' : 'fa-times' }} me-1"></i>
                                            {{ $reservation->Repas1 ? 'Réservé' : 'Non réservé' }}
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        <span class="badge {{ $reservation->Repas2 ? 'bg-success' : 'bg-secondary' }}">
                                            <i class="fas {{ $reservation->Repas2 ? 'fa-check' : 'fa-times' }} me-1"></i>
                                            {{ $reservation->Repas2 ? 'Réservé' : 'Non réservé' }}
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        <span class="badge {{ $reservation->Repas3 ? 'bg-success' : 'bg-secondary' }}">
                                            <i class="fas {{ $reservation->Repas3 ? 'fa-check' : 'fa-times' }} me-1"></i>
                                            {{ $reservation->Repas3 ? 'Réservé' : 'Non réservé' }}
                                        </span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <form action="{{ route('reservations.destroy', $reservation->id) }}"
                                              method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt me-1"></i>Annuler
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <div class="empty-state">
                                            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                                            <p class="text-muted mb-0">Aucune réservation trouvée</p>
                                            <a href="{{ route('reservations.create') }}" class="btn btn-primary mt-3">
                                                <i class="fas fa-plus-circle me-2"></i>Faire une réservation
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .badge {
        padding: 0.5rem 1rem;
        font-weight: 500;
    }
    .empty-state {
        padding: 2rem;
        text-align: center;
    }
    .delete-form button {
        transition: all 0.3s ease;
    }
    .delete-form button:hover {
        transform: translateY(-2px);
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Confirmation de suppression
    const deleteForms = document.querySelectorAll('.delete-form');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')) {
                this.submit();
            }
        });
    });
});
</script>
@endpush
@endsection
