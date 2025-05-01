@extends('layouts.app')

@section('title', 'Mes Réservations')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Mes Réservations</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Petit-déjeuner</th>
                            <th>Déjeuner</th>
                            <th>Dîner</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reservations as $reservation)
                        <tr>
                            <td>{{ date('d/m/Y', strtotime($reservation->DateReservation)) }}</td>
                            <td>{{ $reservation->Repas1 ? '✔' : '✖' }}</td>
                            <td>{{ $reservation->Repas2 ? '✔' : '✖' }}</td>
                            <td>{{ $reservation->Repas3 ? '✔' : '✖' }}</td>
                            <td>
                                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Annuler</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Aucune réservation trouvée</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
