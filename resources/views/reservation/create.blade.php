@extends('layouts.app')

@section('title', 'New Reservation')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">New Meal Reservation</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('reservations.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="DateReservation" class="form-label">Date</label>
                    <input type="date" class="form-control @error('DateReservation') is-invalid @enderror"
                           id="DateReservation" name="DateReservation"
                           value="{{ old('DateReservation') }}" required>
                    @error('DateReservation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <h5>Select Meals:</h5>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="Repas1" name="Repas1"
                               {{ old('Repas1') ? 'checked' : '' }}>
                        <label class="form-check-label" for="Repas1">Petit-déjeuner</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="Repas2" name="Repas2"
                               {{ old('Repas2') ? 'checked' : '' }}>
                        <label class="form-check-label" for="Repas2">Déjeuner</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="Repas3" name="Repas3"
                               {{ old('Repas3') ? 'checked' : '' }}>
                        <label class="form-check-label" for="Repas3">Dîner</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Enregistrer la réservation</button>
                <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection
