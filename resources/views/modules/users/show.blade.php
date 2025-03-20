@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detalles del Usuario</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="user-name" class="fw-bold">Nombre:</label>
                        <p id="user-name">{{ $user->name }}</p>
                    </div>

                    <div class="mb-3">
                        <label for="user-email" class="fw-bold">Email:</label>
                        <p id="user-email">{{ $user->email }}</p>
                    </div>

                    <div class="mb-3">
                        <label for="user-role" class="fw-bold">Rol:</label>
                        <p id="user-role">
                            <span class="badge {{ $user->role === 'admin' ? 'bg-danger' : 'bg-success' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </p>
                    </div>

                    <div class="mb-3">
                        <label for="user-created" class="fw-bold">Fecha de Registro:</label>
                        <p id="user-created">{{ $user->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Volver</a>
                        <div>
                            <a href="{{ route('admin.user.edit', $user) }}" class="btn btn-warning">Editar</a>
                            @if(auth()->user()->id !== $user->id)
                                <form action="{{ route('admin.user.destroy', $user) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">
                                        Eliminar
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
