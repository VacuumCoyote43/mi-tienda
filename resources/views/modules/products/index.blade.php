@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Productos</span>
                        <a href="{{ route('admin.product.create') }}" class="btn btn-primary btn-sm">Nuevo Producto</a>
                    </div>
                    <form action="{{ route('admin.product.index') }}" method="GET" class="d-flex gap-2">
                        <input type="text" name="search" class="form-control form-control-sm" placeholder="Buscar por nombre, descripción, precio, categoría o características..." value="{{ $search ?? '' }}">
                        <button type="submit" class="btn btn-primary btn-sm">Buscar</button>
                        @if($search ?? false)
                            <a href="{{ route('admin.product.index') }}" class="btn btn-secondary btn-sm">Limpiar</a>
                        @endif
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Categoría</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Estado</th>
                                    <th>Características</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-thumbnail" style="max-width: 50px;">
                                        @else
                                            <span class="text-muted">Sin imagen</span>
                                        @endif
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name ?? 'Sin categoría' }}</td>
                                    <td>${{ number_format($product->price, 2) }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>
                                        <span class="badge {{ $product->status ? 'bg-success' : 'bg-danger' }}">
                                            {{ $product->status ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($product->characteristics->count() > 0)
                                            @foreach($product->characteristics->take(3) as $characteristic)
                                                <span class="badge bg-info me-1">
                                                    {{ $characteristic->name }}
                                                </span>
                                            @endforeach
                                            @if($product->characteristics->count() > 3)
                                                <span class="badge bg-secondary">+{{ $product->characteristics->count() - 3 }}</span>
                                            @endif
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.product.show', $product) }}" class="btn btn-info btn-sm">
                                                Ver
                                            </a>
                                            <a href="{{ route('admin.product.edit', $product) }}" class="btn btn-warning btn-sm">
                                                Editar
                                            </a>
                                            <form action="{{ route('admin.product.destroy', $product) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este producto?')">
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
                    <div class="mt-3">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
