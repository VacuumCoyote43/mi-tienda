@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Finalizar Compra</div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('shop.orders.store') }}">
                        @csrf
                        <div class="row">
                            <!-- Resumen del pedido -->
                            <div class="col-md-4">
                                <h5>Resumen del Pedido</h5>
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Producto</th>
                                                <th class="text-end">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($cartItems as $item)
                                                <tr>
                                                    <td>{{ $item->product->name }} x {{ $item->quantity }}</td>
                                                    <td class="text-end">
                                                        ${{ number_format($item->product->price * $item->quantity, 2) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td><strong>Total:</strong></td>
                                                <td class="text-end"><strong>${{ number_format($total, 2) }}</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Formulario de envío -->
                            <div class="col-md-8">
                                <h5>Información de Envío</h5>
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="shipping_address">Dirección</label>
                                        <input type="text"
                                               class="form-control @error('shipping_address') is-invalid @enderror"
                                               id="shipping_address"
                                               name="shipping_address"
                                               value="{{ old('shipping_address') }}"
                                               required>
                                        @error('shipping_address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="shipping_city">Ciudad</label>
                                        <input type="text"
                                               class="form-control @error('shipping_city') is-invalid @enderror"
                                               id="shipping_city"
                                               name="shipping_city"
                                               value="{{ old('shipping_city') }}"
                                               required>
                                        @error('shipping_city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="shipping_state">Provincia/Estado</label>
                                        <input type="text"
                                               class="form-control @error('shipping_state') is-invalid @enderror"
                                               id="shipping_state"
                                               name="shipping_state"
                                               value="{{ old('shipping_state') }}"
                                               required>
                                        @error('shipping_state')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="shipping_zip">Código Postal</label>
                                        <input type="text"
                                               class="form-control @error('shipping_zip') is-invalid @enderror"
                                               id="shipping_zip"
                                               name="shipping_zip"
                                               value="{{ old('shipping_zip') }}"
                                               required>
                                        @error('shipping_zip')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="shipping_country">País</label>
                                        <input type="text"
                                               class="form-control @error('shipping_country') is-invalid @enderror"
                                               id="shipping_country"
                                               name="shipping_country"
                                               value="{{ old('shipping_country') }}"
                                               required>
                                        @error('shipping_country')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="payment_method">Método de Pago</label>
                                        <select class="form-control @error('payment_method') is-invalid @enderror"
                                                id="payment_method"
                                                name="payment_method"
                                                required>
                                            <option value="">Seleccione un método de pago</option>
                                            <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>
                                                Tarjeta de Crédito
                                            </option>
                                            <option value="paypal" {{ old('payment_method') == 'paypal' ? 'selected' : '' }}>
                                                PayPal
                                            </option>
                                            <option value="transfer" {{ old('payment_method') == 'transfer' ? 'selected' : '' }}>
                                                Transferencia Bancaria
                                            </option>
                                        </select>
                                        @error('payment_method')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('shop.cart.index') }}" class="btn btn-secondary">
                                Volver al Carrito
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Confirmar Pedido
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
