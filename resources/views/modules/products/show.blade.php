@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Detalles del Producto</span>
                    <a href="{{ route('admin.product.index') }}" class="btn btn-secondary btn-sm">Volver</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if($product->image)
                            <div class="col-md-4 mb-3">
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     alt="{{ $product->name }}"
                                     class="img-fluid rounded">
                            </div>
                        @endif
                        <div class="col-md-8">
                            <h2>{{ $product->name }}</h2>
                            <p class="text-muted">{{ $product->description }}</p>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Categoría:</strong>
                                    <p>{{ $product->category->name ?? 'Sin categoría' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Precio:</strong>
                                    <p>${{ number_format($product->price, 2) }}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Stock:</strong>
                                    <p>{{ $product->stock }} unidades</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Estado:</strong>
                                    <p>
                                        <span class="badge {{ $product->status ? 'bg-success' : 'bg-danger' }}">
                                            {{ $product->status ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </p>
                                </div>
                            </div>

                            <div class="mb-3">
                                <strong>Características:</strong>
                                @if($product->characteristics->count() > 0)
                                    <div class="mt-2">
                                        @foreach($product->characteristics as $characteristic)
                                            <span class="badge bg-info me-2 mb-2">
                                                {{ $characteristic->name }} ({{ $characteristic->type }}: {{ $characteristic->value }})
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-muted">No hay características asignadas</p>
                                @endif
                            </div>

                            <div class="mt-4">
                                <a href="{{ route('admin.product.edit', $product) }}" class="btn btn-primary">
                                    Editar Producto
                                </a>
                                <form action="{{ route('admin.product.destroy', $product) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('¿Está seguro de eliminar este producto?')">
                                        Eliminar Producto
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
