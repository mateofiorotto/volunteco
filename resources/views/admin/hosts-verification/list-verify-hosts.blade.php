@extends('layouts.admin')

@section('content')
    <section>
        <div class="container py-5">
            <h1 class="title-h1 h3 mb-5">Listado de <span>anfitriones</span></h1>

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
                        @endif
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="card border-primary">
                        <div class="card-header text-bg-primary">
                            <h2 class="h5 mb-0">Anfitriones <span class="fw-light">activos</span></h2>
                        </div>
                        @if ($hostsVerified->isEmpty())
                        <div class="card-body">
                            <p class="mb-0">No hay anfitriones activos</p>
                        </div>
                        @else
                            <x-admin.hosts-list :hosts="$hostsVerified" />
                        @endif
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="card border-danger">
                        <div class="card-header text-bg-danger">
                            <h2 class="h5 mb-0">Anfitriones <span class="fw-light">deshabilitados</span></h2>
                        </div>
                        @if ($hostsDisabled->isEmpty())
                        <div class="card-body">
                            <p class="mb-0">No hay anfitriones rechazados</p>
                        </div>
                        @else
                            <x-admin.hosts-list :hosts="$hostsDisabled" />
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
