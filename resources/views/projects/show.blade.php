@extends('layouts.app')

@section('content')
    {{-- <div class="card" style="width: 18rem;">
        <img src="{{ str_starts_with($project->cover_image, 'https:') ? $project->cover_image :
            asset('storage/' . $project->cover_image) }}" class="card-img-top"
            alt="{{ $project->name }}">

        <div class="card-body">
            <h5 class="card-title"> {{ $project->name }}</h5>
            <h5>{{ $project->client_name }}</h5>
            <p class="card-text"> {{ $project->summary }}.</p>
        </div>
    </div> --}}

    <div class="container">
        <div class="row">

            <div class="col-8">
                <h1 class="display-3"> {{ $project->name }} </h1>
                <h4> {{ $project->client_name }} </h4>
                <p> {!! $project->summary !!} </p>
            </div>

            <div class="col-4">
                <img src="{{ str_starts_with($project->cover_image, 'http')
                    ? $project->cover_image
                    : asset('storage/' . $project->cover_image) }}"
                    class="card-img-top" alt="{{ $project->name }}">


            </div>
        </div>
    </div>
@endsection
