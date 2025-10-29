@extends('layouts.app')

@section('content')
<section class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h1 class="title-h1 h3 mb-0">Admin <span>Dashboard</span></h1>
    </div>

    <div>
        <ul>
        @foreach($users as $user)
            <li>{{ $user->email }} - {{ $user->role->type }} - {{$user->status}}</li>
        @endforeach
        </ul>
    </div>
</section>
@endsection
