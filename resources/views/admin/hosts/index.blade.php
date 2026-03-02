@extends('layouts.admin')

@section('content')
    <section>
        <div class="container py-5">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h1 class="title-h1 h3">Listado de <span>anfitriones</span></h1>
                <a href="{{ url()->previous() }}"
                   class="btn btn-link"><i class="bi bi-chevron-left me-1"></i> Volver</a>
            </div>


            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show"
                     role="alert">
                    <strong>¡Perfecto!</strong> {{ session('success') }}
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="card mb-5 border-warning">
                        <div class="card-header text-bg-warning">
                            <h2 class="h5 mb-0">Anfitriones <span class="fw-light">pendientes de verificación</span></h2>
                        </div>
                        @if ($hostsNotVerified->isEmpty())
                            <div class="card-body">
                                <p class="mb-0">No hay anfitriones para verificar</p>
                            </div>
                        @else
                            <x-admin.hosts-list :hosts="$hostsNotVerified" />
                            @if ($hostsNotVerified->hasPages())
                                <div class="card-footer">
                                    <div class="d-flex justify-content-center">
                                        {{ $hostsNotVerified->links() }}
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="card border-danger">
                        <div class="card-header text-bg-danger">
                            <h2 class="h5 mb-0">Anfitriones <span class="fw-light">deshabilitados/rechazados</span></h2>
                        </div>
                        @if ($hostsDisabled->isEmpty())
                            <div class="card-body">
                                <p class="mb-0">No hay anfitriones rechazados</p>
                            </div>
                        @else
                            <x-admin.hosts-list :hosts="$hostsDisabled" />
                            @if ($hostsDisabled->hasPages())
                                <div class="card-footer">
                                    <div class="d-flex justify-content-center">
                                        {{ $hostsDisabled->links() }}
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="col-12">
                    <div class="card mb-5 border-primary">
                        <div class="card-header text-bg-primary">
                            <h2 class="h5 mb-0">Anfitriones <span class="fw-light">activos</span></h2>
                        </div>
                        @if ($hostsVerified->isEmpty())
                            <div class="card-body">
                                <p class="mb-0">No hay anfitriones activos</p>
                            </div>
                        @else
                            <x-admin.hosts-list :hosts="$hostsVerified" />
                            @if ($hostsVerified->hasPages())
                                <div class="card-footer">
                                     {{ $hostsVerified->links() }}
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
