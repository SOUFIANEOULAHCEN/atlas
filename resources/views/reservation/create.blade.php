@extends('layouts.app')

@section('title', 'Nouvelle Réservation')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">
                        <i class="fas fa-utensils me-2"></i>Nouvelle Réservation
                    </h4>
                    <a href="{{ route('reservations.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Retour
                    </a>
                </div>

                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('reservations.store') }}" class="needs-validation" novalidate>
                        @csrf
                        <div class="mb-4">
                            <label for="DateReservation" class="form-label">
                                <i class="fas fa-calendar-alt me-1"></i>Date de réservation
                            </label>
                            <input type="date" class="form-control form-control-lg @error('DateReservation') is-invalid @enderror"
                                   id="DateReservation" name="DateReservation"
                                   value="{{ old('DateReservation', date('Y-m-d')) }}" required>
                            @error('DateReservation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-transparent">
                                <h5 class="mb-0">
                                    <i class="fas fa-hamburger me-2"></i>Sélection des Repas
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <div class="meal-option">
                                            <input type="checkbox" class="btn-check" id="Repas1" name="Repas1"
                                                   {{ old('Repas1') ? 'checked' : '' }} autocomplete="off">
                                            <label class="btn btn-outline-primary w-100 h-100 d-flex flex-column align-items-center justify-content-center p-4"
                                                   for="Repas1">
                                                <i class="fas fa-sun fa-2x mb-2"></i>
                                                <span>Petit-déjeuner</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="meal-option">
                                            <input type="checkbox" class="btn-check" id="Repas2" name="Repas2"
                                                   {{ old('Repas2') ? 'checked' : '' }} autocomplete="off">
                                            <label class="btn btn-outline-primary w-100 h-100 d-flex flex-column align-items-center justify-content-center p-4"
                                                   for="Repas2">
                                                <i class="fas fa-cloud-sun fa-2x mb-2"></i>
                                                <span>Déjeuner</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="meal-option">
                                            <input type="checkbox" class="btn-check" id="Repas3" name="Repas3"
                                                   {{ old('Repas3') ? 'checked' : '' }} autocomplete="off">
                                            <label class="btn btn-outline-primary w-100 h-100 d-flex flex-column align-items-center justify-content-center p-4"
                                                   for="Repas3">
                                                <i class="fas fa-moon fa-2x mb-2"></i>
                                                <span>Dîner</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>Enregistrer la réservation
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .meal-option label {
        transition: all 0.3s ease;
        border-radius: 15px;
    }

    .meal-option label:hover {
        transform: translateY(-3px);
    }

    .btn-check:checked + label {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: var(--text-dark);
        border-color: var(--primary-dark);
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set min date to today
    const dateInput = document.getElementById('DateReservation');
    dateInput.min = new Date().toISOString().split('T')[0];
});
</script>
@endpush
@endsection
