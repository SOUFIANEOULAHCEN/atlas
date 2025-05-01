@extends('layouts.app')

@section('title', 'Espace Personnel')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Mon Espace Personnel</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="list-group">
                                <a href="{{ route('profile.show') }}" class="list-group-item list-group-item-action">Mon Profil</a>
                                <a href="{{ route('reservations.index') }}" class="list-group-item list-group-item-action active">Réservations</a>
                                <a href="{{ route('reservations.create') }}" class="list-group-item list-group-item-action">Nouvelle Réservation</a>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <h5>Bienvenue, {{ Auth::user()->Prenom }}!</h5>

                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="mb-4">
                                <a href="{{ route('reservations.create') }}" class="btn btn-primary">
                                    + Nouvelle Réservation
                                </a>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered">
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
                                            <td>{{ \Carbon\Carbon::parse($reservation->DateReservation)->format('d/m/Y') }}</td>
                                            <td>{{ $reservation->Repas1 ? '✔' : '✖' }}</td>
                                            <td>{{ $reservation->Repas2 ? '✔' : '✖' }}</td>
                                            <td>{{ $reservation->Repas3 ? '✔' : '✖' }}</td>
                                            <td>
                                                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
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
            </div>
        </div>
    </div>
</div>
@endsection
