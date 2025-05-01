@extends('layouts.app')

@section('title', 'Gestion des utilisateurs')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.sidebar')

        <main class="col-md-9 ms-sm-auto px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Gestion des utilisateurs</h1>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Matricule</th>
                            <th>Photo</th>
                            <th>Nom & Prénom</th>
                            <th>Login</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->Matricule }}</td>
                            <td>
                                @if($user->photo)
                                    <img src="{{ asset('storage/'.$user->photo) }}" class="rounded-circle" alt="Photo" width="40" height="40">
                                @else
                                    <img src="{{ asset('images/default-profile.png') }}" class="rounded-circle" alt="Default" width="40" height="40">
                                @endif
                            </td>
                            <td>{{ $user->nom }} {{ $user->Prenom }}</td>
                            <td>{{ $user->login }}</td>
                            <td>{{ $user->Email }}</td>
                            <td>
                                <span class="badge {{ $user->TypeCompte === 'admin' ? 'bg-danger' : 'bg-success' }}">
                                    {{ ucfirst($user->TypeCompte) }}
                                </span>
                            </td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('admin.users.edit', $user->Matricule) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>

                                <form action="{{ route('admin.users.destroy', $user->Matricule) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i> Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    {{ $users->links() }}
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
