@extends('layouts.app')

@section('title', 'Admin - Reservations')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.sidebar')

        <main class="col-md-9 ms-sm-auto px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">All Reservations</h1>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>User</th>
                            <th>Petit-déjeuner</th>
                            <th>Déjeuner</th>
                            <th>Dîner</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->DateReservation->format('d/m/Y') }}</td>
                            <td>{{ $reservation->compte->nom }} {{ $reservation->compte->Prenom }}</td>
                            <td>{{ $reservation->Repas1 ? '✔' : '✖' }}</td>
                            <td>{{ $reservation->Repas2 ? '✔' : '✖' }}</td>
                            <td>{{ $reservation->Repas3 ? '✔' : '✖' }}</td>
                            <td>
                                <form action="{{ route('admin.reservations.destroy', $reservation->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $reservations->links() }}
            </div>
        </main>
    </div>
</div>
@endsection
