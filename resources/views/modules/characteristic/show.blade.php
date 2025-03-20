@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detalles de la Característica</div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Nombre:</dt>
                        <dd class="col-sm-9">{{ $characteristic->name }}</dd>

                        <dt class="col-sm-3">Tipo:</dt>
                        <dd class="col-sm-9">{{ ucfirst($characteristic->type) }}</dd>

                        <dt class="col-sm-3">Valor por defecto:</dt>
                        <dd class="col-sm-9">{{ $characteristic->value }}</dd>

                        <dt class="col-sm-3">Creado:</dt>
                        <dd class="col-sm-9">{{ $characteristic->created_at->format('d/m/Y H:i') }}</dd>

                        <dt class="col-sm-3">Actualizado:</dt>
                        <dd class="col-sm-9">{{ $characteristic->updated_at->format('d/m/Y H:i') }}</dd>
                    </dl>
                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('admin.characteristic.index') }}" class="btn btn-secondary">Volver</a>
                        <a href="{{ route('admin.characteristic.edit', $characteristic->id) }}" class="btn btn-primary">Editar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
