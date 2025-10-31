@extends('layouts.admin')

@section('content')
<section>
    <div class="container py-5">
        <h1 class="title-h1 h3 mb-5">Listado de <span>Voluntarios</span></h1>
        <div class="row">
            <div class="col-md-6">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                        <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $volunteers as $volunteer)
                        <tr>
                            <th scope="row">{{$volunteer->id}}</th>
                            <td>{{$volunteer->volunteer->full_name}}</td>
                            <td>{{$volunteer->email}}</td>
                            <td>{{ucfirst($volunteer->status)}}</td>
                            <td>
                                <a href="{{ route('admin.volunteer.profile', $volunteer->id) }}" class="btn btn-primary">Ver Perfil</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
