@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="mb-4" width="120">
            <h1 class="mb-4">Welcome to Atlas Restaurant</h1>
            <p class="lead mb-5">Meal reservation system for staff members</p>

            <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 gap-3">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg px-4">Register</a>
                @else
                    <a href="{{ Auth::user()->TypeCompte === 'admin' ? route('admin.dashboard') : route('user.dashboard') }}"
                       class="btn btn-primary btn-lg px-4 gap-3">
                        Go to Dashboard
                    </a>
                @endguest
            </div>
        </div>
    </div>
</div>
@endsection
