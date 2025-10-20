@extends('layouts.app')

@section('content')
    <section class="container text-break pt-5 pb-5">
        <h2>Detalles del proyecto</h2>
        <div class="project-details">
            <h3>{{ $project->title }}</h3>
            <p>{{ $project->description }}</p>
            <p>ℹ️ {{ $project->projectType->name }}</p>
            @if($project->conditions->isNotEmpty())
                <ul>
                    @foreach($project->conditions as $condition)
                        <li>{{ $condition->description }}</li>
                    @endforeach
                </ul>
            @endif
            <!--form con btn para aplicar al proyecto-->
            {{-- <form method="POST" action="{{ route('apply-project', $project->id)
    }}">
                    @csrf
                    <button class="btn btn-primary mt-4" type="submit">Aplicar al proyecto</button>
                </form>
            </div> --}}
    </section>
@endsection