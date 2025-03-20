@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Documentación del Proyecto</h5>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>
                </div>
                <div class="card-body">
                    <div class="markdown-content">
                        {!! Str::markdown($content) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.markdown-content h1 { font-size: 2rem; margin-bottom: 1rem; }
.markdown-content h2 { font-size: 1.75rem; margin-top: 2rem; margin-bottom: 1rem; }
.markdown-content h3 { font-size: 1.5rem; margin-top: 1.5rem; margin-bottom: 0.75rem; }
.markdown-content p { margin-bottom: 1rem; }
.markdown-content ul { margin-bottom: 1rem; }
.markdown-content code { background-color: #f8f9fa; padding: 0.2rem 0.4rem; border-radius: 0.25rem; }
.markdown-content pre { background-color: #f8f9fa; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem; overflow-x: auto; }
.markdown-content pre code { background-color: transparent; padding: 0; }
</style>
@endsection
