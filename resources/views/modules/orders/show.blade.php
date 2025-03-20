@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detalles del Pedido #{{ $order->id }}</h5>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6>Información del Cliente</h6>
                            <dl class="row">
                                <dt class="col-sm-4">Nombre:</dt>
                                <dd class="col-sm-8">{{ $order->user->name }}</dd>
                                <dt class="col-sm-4">Email:</dt>
                                <dd class="col-sm-8">{{ $order->user->email }}</dd>
                                <dt class="col-sm-4">Fecha del Pedido:</dt>
                                <dd class="col-sm-8">{{ $order->created_at->format('d/m/Y H:i') }}</dd>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <h6>Estado del Pedido</h6>
                            <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="input-group">
                                    <select name="status" class="form-select">
                                        @foreach(['pending', 'paid', 'shipped', 'delivered', 'cancelled'] as $status)
                                            <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-lg"></i> Actualizar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <h6>Productos</h6>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Precio Unitario</th>
                                    <th>Cantidad</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderLines as $line)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($line->product->image)
                                                    <img src="{{ asset('storage/' . $line->product->image) }}"
                                                         alt="{{ $line->product->name }}"
                                                         class="img-thumbnail me-2"
                                                         style="width: 50px; height: 50px; object-fit: cover;">
                                                @endif
                                                {{ $line->product->name }}
                                            </div>
                                        </td>
                                        <td>€{{ number_format($line->price, 2) }}</td>
                                        <td>{{ $line->quantity }}</td>
                                        <td>€{{ number_format($line->price * $line->quantity, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                    <td><strong>€{{ number_format($order->total, 2) }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
