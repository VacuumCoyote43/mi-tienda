@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Usuarios</h5>
                                    <p class="card-text">Total de usuarios: {{ $userCount ?? 0 }}</p>
                                    <a href="{{ route('admin.user.index') }}" class="btn btn-primary">Ver usuarios</a>
                                </div>
                            </div>
                        </div>
                        <div class="col mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Productos</h5>
                                    <p class="card-text">Total de productos: {{ $productCount ?? 0 }}</p>
                                    <a href="{{ route('admin.product.index') }}" class="btn btn-primary">Ver productos</a>
                                </div>
                            </div>
                        </div>
                        <div class="col mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Categorías</h5>
                                    <p class="card-text">Total de categorías: {{ $categoryCount ?? 0 }}</p>
                                    <a href="{{ route('admin.category.index') }}" class="btn btn-primary">Ver categorías</a>
                                </div>
                            </div>
                        </div>
                        <div class="col mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Características</h5>
                                    <p class="card-text">Total de características: {{ $characteristicCount ?? 0 }}</p>
                                    <a href="{{ route('admin.characteristic.index') }}" class="btn btn-primary">Ver características</a>
                                </div>
                            </div>
                        </div>
                        <div class="col mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Pedidos</h5>
                                    <p class="card-text">Total de pedidos: {{ $orderCount ?? 0 }}</p>
                                    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">Ver pedidos</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
