@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Categorías</span>
                        <a href="{{ route('admin.category.create') }}" class="btn btn-primary btn-sm">Nueva Categoría</a>
                    </div>
                    <form action="{{ route('admin.category.index') }}" method="GET" class="d-flex gap-2">
                        <input type="text" name="search" class="form-control form-control-sm" placeholder="Buscar por nombre o descripción..." value="{{ $search ?? '' }}">
                        <button type="submit" class="btn btn-primary btn-sm">Buscar</button>
                        @if($search ?? false)
                            <a href="{{ route('admin.category.index') }}" class="btn btn-secondary btn-sm">Limpiar</a>
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
                                    <th>Descripción</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->description }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.category.show', $category->id) }}" class="btn btn-info btn-sm">Ver</a>
                                                <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                                <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar esta categoría?')">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
