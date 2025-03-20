@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Detalles del Pedido #{{ $order->id }}</span>
                    <a href="{{ route('shop.orders.index') }}" class="btn btn-secondary btn-sm">Volver a Mis Pedidos</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Información del pedido -->
                        <div class="col-md-6">
                            <h5>Información del Pedido</h5>
                            <dl class="row">
                                <dt class="col-sm-4">Estado:</dt>
                                <dd class="col-sm-8">
                                    <span class="badge bg-{{ $order->status === 'pending' ? 'warning' :
                                        ($order->status === 'paid' ? 'success' :
                                        ($order->status === 'shipped' ? 'info' :
                                        ($order->status === 'delivered' ? 'primary' : 'danger'))) }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </dd>

                                <dt class="col-sm-4">Fecha:</dt>
                                <dd class="col-sm-8">{{ $order->created_at->format('d/m/Y H:i') }}</dd>

                                <dt class="col-sm-4">Método de Pago:</dt>
                                <dd class="col-sm-8">{{ ucfirst($order->payment_method) }}</dd>

                                <dt class="col-sm-4">Total:</dt>
                                <dd class="col-sm-8">${{ number_format($order->total, 2) }}</dd>
                            </dl>
                        </div>

                        <!-- Dirección de envío -->
                        <div class="col-md-6">
                            <h5>Dirección de Envío</h5>
                            <address>
                                {{ $order->shipping_address }}<br>
                                {{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_zip }}<br>
                                {{ $order->shipping_country }}
                            </address>
                        </div>

                        <!-- Productos -->
                        <div class="col-12 mt-4">
                            <h5>Productos</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->orderLines as $line)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if($line->product->image)
                                                            <img src="{{ asset('storage/' . $line->product->image) }}"
                                                                 alt="{{ $line->product->name }}"
                                                                 class="img-thumbnail me-2"
                                                                 style="width: 50px; height: 50px; object-fit: cover;">
                                                        @endif
                                                        <div>
                                                            <h6 class="mb-0">{{ $line->product->name }}</h6>
                                                            <small class="text-muted">{{ $line->product->category->name }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>${{ number_format($line->price, 2) }}</td>
                                                <td>{{ $line->quantity }}</td>
                                                <td>${{ number_format($line->total, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                            <td><strong>${{ number_format($order->total, 2) }}</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
