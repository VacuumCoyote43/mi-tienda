@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Características</span>
                        <a href="{{ route('admin.characteristic.create') }}" class="btn btn-primary btn-sm">Nueva Característica</a>
                    </div>
                    <form action="{{ route('admin.characteristic.index') }}" method="GET" class="d-flex gap-2">
                        <input type="text" name="search" class="form-control form-control-sm" placeholder="Buscar por nombre o descripción..." value="{{ $search ?? '' }}">
                        <button type="submit" class="btn btn-primary btn-sm">Buscar</button>
                        @if($search ?? false)
                            <a href="{{ route('admin.characteristic.index') }}" class="btn btn-secondary btn-sm">Limpiar</a>
                        @endif
                    </form>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                    <th>Valor</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($characteristics as $characteristic)
                                    <tr>
                                        <td>{{ $characteristic->id }}</td>
                                        <td>{{ $characteristic->name }}</td>
                                        <td>{{ $characteristic->type }}</td>
                                        <td>{{ $characteristic->value }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.characteristic.show', $characteristic) }}" class="btn btn-info btn-sm">
                                                    Ver
                                                </a>
                                                <a href="{{ route('admin.characteristic.edit', $characteristic) }}" class="btn btn-warning btn-sm">
                                                    Editar
                                                </a>
                                                <form action="{{ route('admin.characteristic.destroy', $characteristic) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar esta característica?')">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $characteristics->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
