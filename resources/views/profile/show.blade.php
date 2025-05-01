@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">My Profile</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="{{ asset(Auth::user()->photo ? 'storage/'.Auth::user()->photo : 'images/default-profile.png') }}"
                                 class="img-thumbnail mb-3" width="150" alt="Profile Photo">
                            <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-primary">Edit Profile</a>
                        </div>
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Matricule</th>
                                    <td>{{ Auth::user()->Matricule }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ Auth::user()->nom }} {{ Auth::user()->Prenom }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ Auth::user()->Email }}</td>
                                </tr>
                                <tr>
                                    <th>Account Type</th>
                                    <td>{{ ucfirst(Auth::user()->TypeCompte) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
