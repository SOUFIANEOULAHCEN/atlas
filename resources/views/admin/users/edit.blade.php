@extends('layouts.app')

@section('title', 'Modifier un utilisateur')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.sidebar')

        <main class="col-md-9 ms-sm-auto px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Modifier un utilisateur</h1>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.users.update', $user->Matricule) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-4">
                            <div class="col-md-3 text-center">
                                <img src="{{ asset($user->photo ? 'storage/'.$user->photo : 'images/default-profile.png') }}"
                                     class="img-thumbnail mb-3" width="150" alt="Profile Photo">
                                <div class="mb-3">
                                    <label for="photo" class="form-label">Changer la photo</label>
                                    <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                           id="photo" name="photo">
                                    @error('photo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="Matricule" class="form-label">Matricule</label>
                                        <input type="text" class="form-control" id="Matricule" value="{{ $user->Matricule }}" disabled>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="login" class="form-label">Login</label>
                                        <input type="text" class="form-control @error('login') is-invalid @enderror"
                                               id="login" name="login" value="{{ old('login', $user->login) }}" required>
                                        @error('login')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="nom" class="form-label">Nom</label>
                                        <input type="text" class="form-control @error('nom') is-invalid @enderror"
                                               id="nom" name="nom" value="{{ old('nom', $user->nom) }}" required>
                                        @error('nom')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="Prenom" class="form-label">Prénom</label>
                                        <input type="text" class="form-control @error('Prenom') is-invalid @enderror"
                                               id="Prenom" name="Prenom" value="{{ old('Prenom', $user->Prenom) }}" required>
                                        @error('Prenom')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="Email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('Email') is-invalid @enderror"
                                               id="Email" name="Email" value="{{ old('Email', $user->Email) }}" required>
                                        @error('Email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="TypeCompte" class="form-label">Type de compte</label>
                                        <select class="form-select @error('TypeCompte') is-invalid @enderror"
                                                id="TypeCompte" name="TypeCompte" required>
                                            <option value="admin" {{ $user->TypeCompte === 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="personnel" {{ $user->TypeCompte === 'personnel' ? 'selected' : '' }}>Personnel</option>
                                        </select>
                                        @error('TypeCompte')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Changer le mot de passe</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="new_password" class="form-label">Nouveau mot de passe</label>
                                        <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                               id="new_password" name="new_password">
                                        <div class="form-text">Laissez vide pour conserver le mot de passe actuel</div>
                                        @error('new_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="new_password_confirmation" class="form-label">Confirmer le mot de passe</label>
                                        <input type="password" class="form-control"
                                               id="new_password_confirmation" name="new_password_confirmation">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Enregistrer les modifications
                            </button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Retour
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
