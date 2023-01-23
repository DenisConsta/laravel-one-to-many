@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {!! session('success') !!}
        </div>
    @endif

    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th scope="col"> <a href=" {{ route('admin.projects.orderby', ['id', $direction]) }} ">ID</a> </th>
                <th scope="col"> <a href=" {{ route('admin.projects.orderby', ['name', $direction]) }} ">Name</a> </th>
                <th scope="col"> <a href=" {{ route('admin.projects.orderby', ['client_name', $direction]) }} ">Client</a>
                </th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td> {{ $project->id }} </td>
                    <td> {{ $project->name }} @if ($project->type?->name)
                            <span class="badge text-bg-info">{{ $project->type?->name }}
                        @endif
                    </td>
                    <td> {{ $project->client_name }} </td>
                    <td>
                        <div class="btns">
                            <a href=" {{ route('admin.projects.show', $project) }} " title="show"
                                class="btn btn-primary"><i class="fa-regular fa-eye"></i></a>
                            <a href=" {{ route('admin.projects.edit', $project) }} " title="edit"
                                class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>

                            @include('admin.partials.form-delete')
                            {{-- <form class="d-inline" action=" {{ route('admin.projects.destroy', $project) }} " method="POST"
                                onsubmit="return confirm('Sei sicuro di voler eliminare {{ $project->name }} ')">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger" title="delete">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form> --}}
                        </div>
                    </td>
                </tr>
            @endforeach


        </tbody>
    </table>

    <div class="d-flex justify-content-between align-items-center ">
        <div class="">
            <h6>
                Showing {{ $projects->firstItem() }} - {{ $projects->lastItem() }} / {{ $projects->total() }}
            </h6>
        </div>
        <div class="">
            {{ $projects->appends($_GET)->links() }}
        </div>
    </div>
@endsection
