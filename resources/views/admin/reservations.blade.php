@extends('layouts.app')

@section('title', 'Administration - Réservations')

@section('content')
<div class="container-fluid p-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                <h1 class="h2">
                    <i class="fas fa-list-alt me-2 text-primary"></i>Toutes les Réservations
                </h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="window.print()">
                            <i class="fas fa-print me-1"></i>Imprimer
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-primary" id="exportCSV">
                            <i class="fas fa-download me-1"></i>Exporter CSV
                        </button>
                    </div>
                    <button type="button" class="btn btn-sm btn-primary" id="refreshData">
                        <i class="fas fa-sync-alt me-1"></i>Actualiser
                    </button>
                </div>
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
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">
                                        <i class="fas fa-calendar-day me-2"></i>Date
                                    </th>
                                    <th>
                                        <i class="fas fa-user me-2"></i>Utilisateur
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
                                @foreach($reservations as $reservation)
                                <tr>
                                    <td class="ps-4">
                                        {{ date('d/m/Y', strtotime($reservation->DateReservation)) }}
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset($reservation->compte->photo ?? 'images/default-profile.png') }}"
                                                 alt="Photo de profil"
                                                 class="rounded-circle me-2"
                                                 width="32" height="32">
                                            <div>
                                                <div class="fw-bold">{{ $reservation->compte->nom }} {{ $reservation->compte->Prenom }}</div>
                                                <small class="text-muted">{{ $reservation->compte->Matricule }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge {{ $reservation->Repas1 ? 'bg-success' : 'bg-secondary' }}">
                                            <i class="fas {{ $reservation->Repas1 ? 'fa-check' : 'fa-times' }} me-1"></i>
                                            {{ $reservation->Repas1 ? 'Réservé' : 'Non réservé' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $reservation->Repas2 ? 'bg-success' : 'bg-secondary' }}">
                                            <i class="fas {{ $reservation->Repas2 ? 'fa-check' : 'fa-times' }} me-1"></i>
                                            {{ $reservation->Repas2 ? 'Réservé' : 'Non réservé' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $reservation->Repas3 ? 'bg-success' : 'bg-secondary' }}">
                                            <i class="fas {{ $reservation->Repas3 ? 'fa-check' : 'fa-times' }} me-1"></i>
                                            {{ $reservation->Repas3 ? 'Réservé' : 'Non réservé' }}
                                        </span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <form action="{{ route('admin.reservations.destroy', $reservation->id) }}"
                                              method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt me-1"></i>Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $reservations->links() }}
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
    .delete-form button {
        transition: all 0.3s ease;
    }
    .delete-form button:hover {
        transform: translateY(-2px);
    }
    @media print {
        .btn-toolbar, .delete-form, nav, footer {
            display: none !important;
        }
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
            if (confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')) {
                this.submit();
            }
        });
    });

    // Rafraîchissement des données
    document.getElementById('refreshData').addEventListener('click', function() {
        location.reload();
    });

    // Export CSV
    document.getElementById('exportCSV').addEventListener('click', function() {
        const table = document.querySelector('table');
        let csv = [];

        // Headers
        let headers = [];
        table.querySelectorAll('thead th').forEach(th => {
            headers.push(th.textContent.trim());
        });
        csv.push(headers.join(','));

        // Rows
        table.querySelectorAll('tbody tr').forEach(tr => {
            let row = [];
            tr.querySelectorAll('td').forEach((td, index) => {
                if (index === 1) { // Colonne utilisateur
                    row.push(td.querySelector('.fw-bold').textContent.trim());
                } else if (index > 1 && index < 5) { // Colonnes de repas
                    row.push(td.querySelector('.badge').textContent.trim());
                } else if (index !== 5) { // Éviter la colonne d'actions
                    row.push(td.textContent.trim());
                }
            });
            csv.push(row.join(','));
        });

        // Téléchargement
        const csvContent = csv.join('\n');
        const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.setAttribute('download', 'reservations.csv');
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });
});
</script>
@endpush
@endsection
