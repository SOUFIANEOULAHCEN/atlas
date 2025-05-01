@extends('layouts.app')

@section('title', 'Bienvenue')

@section('content')
<div class="container">
    <div class="row align-items-center min-vh-75">
        <div class="col-lg-6 order-lg-2">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid mb-4 mb-lg-0 animate__animated animate__fadeInRight">
        </div>
        <div class="col-lg-6 order-lg-1">
            <div class="text-center text-lg-start animate__animated animate__fadeInLeft">
                <h1 class="display-4 fw-bold mb-4">Atlas Restaurant</h1>
                <p class="lead mb-4">Bienvenue sur le système de réservation de repas pour le personnel. Connectez-vous pour gérer vos réservations.</p>
                <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-lg-start">
                    @auth
                        <a href="{{ Auth::user()->TypeCompte === 'admin' ? route('admin.dashboard') : route('user.dashboard') }}"
                           class="btn btn-primary btn-lg px-4 gap-3">
                            <i class="fas fa-utensils me-2"></i>Accéder aux réservations
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 gap-3">
                            <i class="fas fa-sign-in-alt me-2"></i>Connexion
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg px-4">
                            <i class="fas fa-user-plus me-2"></i>Inscription
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5 g-4">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-calendar-check fa-3x text-primary"></i>
                    </div>
                    <h5 class="card-title">Réservation Facile</h5>
                    <p class="card-text">Réservez vos repas en quelques clics pour la journée ou la semaine.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-clock fa-3x text-primary"></i>
                    </div>
                    <h5 class="card-title">Gestion du Temps</h5>
                    <p class="card-text">Planifiez vos repas à l'avance et évitez les files d'attente.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-chart-pie fa-3x text-primary"></i>
                    </div>
                    <h5 class="card-title">Suivi Simple</h5>
                    <p class="card-text">Consultez l'historique de vos réservations en un coup d'œil.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<style>
    .min-vh-75 {
        min-height: 75vh;
    }
    .feature-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: var(--text-dark);
    }
</style>
@endpush
@endsection
