@extends('layouts.app')

@section('title', 'Gestion des utilisateurs')

@section('content')
<div class="container-fluid p-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <div class="d-flex align-items-center">
                    <h1 class="h2 mb-0">
                        <i class="fas fa-users me-2 text-primary"></i>Gestion des utilisateurs
                    </h1>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">
                                        <i class="fas fa-id-card me-2"></i>Matricule
                                    </th>
                                    <th>Photo</th>
                                    <th>
                                        <i class="fas fa-user me-2"></i>Nom & Prénom
                                    </th>
                                    <th>
                                        <i class="fas fa-user-tag me-2"></i>Login
                                    </th>
                                    <th>
                                        <i class="fas fa-envelope me-2"></i>Email
                                    </th>
                                    <th>
                                        <i class="fas fa-user-shield me-2"></i>Type
                                    </th>
                                    <th class="text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td class="ps-4 text-muted">{{ $user->Matricule }}</td>
                                    <td>
                                        <div class="user-avatar">
                                            @if($user->photo)
                                                <img src="{{ asset('storage/'.$user->photo) }}"
                                                     class="rounded-circle" alt="Photo"
                                                     width="40" height="40">
                                            @else
                                                <img src="{{ asset('images/default-profile.png') }}"
                                                     class="rounded-circle" alt="Default"
                                                     width="40" height="40">
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-bold">{{ $user->nom }} {{ $user->Prenom }}</div>
                                    </td>
                                    <td class="text-muted">{{ $user->login }}</td>
                                    <td class="text-muted">{{ $user->Email }}</td>
                                    <td>
                                        <span class="badge {{ $user->TypeCompte === 'admin' ? 'bg-primary' : 'bg-success' }}">
                                            {{ ucfirst($user->TypeCompte) }}
                                        </span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="d-flex gap-2 justify-content-end">
                                            <a href="{{ route('admin.users.edit', $user->Matricule) }}"
                                               class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit me-1"></i>Modifier
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user->Matricule) }}"
                                                  method="POST"
                                                  class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash-alt me-1"></i>Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="pagination-info">
                    Affichage de {{ $users->firstItem() }} à {{ $users->lastItem() }} sur {{ $users->total() }} utilisateurs
                </div>
                <div>
                    {{ $users->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.table {
    --bs-table-hover-bg: rgba(var(--bs-primary-rgb), 0.05);
}

.table th {
    background: #f8f9fa;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
    padding: 1rem;
}

.table td {
    padding: 1rem;
    vertical-align: middle;
}

.user-avatar img {
    object-fit: cover;
    border: 2px solid var(--primary-color);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.badge {
    padding: 0.5rem 1rem;
    font-weight: 500;
    border-radius: 30px;
}

.btn-sm {
    padding: 0.4rem 0.8rem;
    font-size: 0.875rem;
}

.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 0.5rem;
    margin-top: 1rem;
}

.page-item {
    list-style: none;
}

.page-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #fff;
    color: #6c757d;
    border: 1px solid #dee2e6;
    transition: all 0.3s ease;
    font-size: 0.9rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.page-link:hover {
    background-color: var(--primary-color);
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.page-item.active .page-link {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: #fff;
    font-weight: bold;
    box-shadow: 0 4px 10px rgba(255, 215, 0, 0.4);
}

.page-item.disabled .page-link {
    background-color: #f8f9fa;
    color: #adb5bd;
    cursor: not-allowed;
    box-shadow: none;
}

.pagination-info {
    font-size: 0.9rem;
    color: #6c757d;
    padding-left: 0.5rem;
}

.page-item:first-child .page-link::before {
    content: '«';
    margin-right: 0.2rem;
}

.page-item:last-child .page-link::after {
    content: '»';
    margin-left: 0.2rem;
}

.page-link:hover {
    background: var(--primary-color);
    color: var(--text-dark);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.page-item.active .page-link {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: var(--text-dark);
    font-weight: 500;
    box-shadow: 0 4px 10px rgba(255, 215, 0, 0.3);
}

.page-item.disabled .page-link {
    background: #f8f9fa;
    color: #6c757d;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.table tr:hover .btn {
    opacity: 1;
}

.table .btn {
    opacity: 0.8;
    transition: all 0.3s ease;
}

.table .btn:hover {
    transform: translateY(-2px);
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Confirmation de suppression
    const deleteForms = document.querySelectorAll('.delete-form');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {
                this.submit();
            }
        });
    });
});
</script>
@endpush
@endsection
