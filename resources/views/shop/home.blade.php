@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Sidebar con categorías -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    Categorías
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('shop.home') }}"
                       class="list-group-item list-group-item-action {{ !request('category') ? 'active' : '' }}">
                        Todas
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('shop.home', ['category' => $category->id]) }}"
                           class="list-group-item list-group-item-action {{ request('category') == $category->id ? 'active' : '' }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Productos -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <form action="{{ route('shop.home') }}" method="GET" class="d-flex gap-2">
                        @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        <input type="text" name="search" class="form-control"
                               placeholder="Buscar productos..."
                               value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                        @if(request('search'))
                            <a href="{{ url()->current() }}" class="btn btn-secondary">Limpiar</a>
                        @endif
                    </form>
                </div>
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @forelse($products as $product)
                            <div class="col">
                                <div class="card h-100">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                             class="card-img-top"
                                             alt="{{ $product->name }}">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text text-muted">{{ Str::limit($product->description, 100) }}</p>
                                        <p class="card-text">
                                            <strong>Precio:</strong> ${{ number_format($product->price, 2) }}
                                        </p>
                                        <form action="{{ route('shop.cart.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn btn-primary">
                                                Añadir al carrito
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-center">No se encontraron productos.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
