@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Register New Account</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="Matricule" class="form-label">Matricule</label>
                                    <input type="text" class="form-control @error('Matricule') is-invalid @enderror"
                                        id="Matricule" name="Matricule" required>
                                    @error('Matricule')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="login" class="form-label">Username</label>
                                    <input type="text" class="form-control @error('login') is-invalid @enderror"
                                        id="login" name="login" required>
                                    @error('login')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="motdepasse" class="form-label">Password</label>
                                    <input type="password" class="form-control @error('motdepasse') is-invalid @enderror"
                                        id="motdepasse" name="motdepasse" required>
                                    @error('motdepasse')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="motdepasse_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="motdepasse_confirmation"
                                        name="motdepasse_confirmation" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Last Name</label>
                                    <input type="text" class="form-control @error('nom') is-invalid @enderror"
                                        id="nom" name="nom" required>
                                    @error('nom')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="Prenom" class="form-label">First Name</label>
                                    <input type="text" class="form-control @error('Prenom') is-invalid @enderror"
                                        id="Prenom" name="Prenom" required>
                                    @error('Prenom')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="Email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('Email') is-invalid @enderror"
                                        id="Email" name="Email" required>
                                    @error('Email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="TypeCompte" class="form-label">Account Type</label>
                                    <select class="form-select @error('TypeCompte') is-invalid @enderror" id="TypeCompte"
                                        name="TypeCompte" required>
                                        <option value="">Select Type</option>
                                        <option value="admin">Admin</option>
                                        <option value="personnel">Personnel</option>
                                    </select>
                                    @error('TypeCompte')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="photo" class="form-label">Profile Photo</label>
                            <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo"
                                name="photo">
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Register</button>
                    </form>

                    <div class="mt-3 text-center">
                        <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
