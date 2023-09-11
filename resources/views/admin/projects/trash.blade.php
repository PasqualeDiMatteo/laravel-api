@extends('layouts.app')

@section('title', 'Trash')

@section('content')
    <h1 class="text-center">Cestino</h1>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titolo</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($projects as $project)
                    <tr>
                        <th scope="row">{{ $project->id }}</th>
                        <td>{{ $project->title }}</td>
                        <td>
                            <div class="d-flex justify-content-end gap-2">
                                <form action="{{ route('admin.projects.restore', $project->id) }}"method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success">Ripristina</button>
                                </form>
                                <form action="{{ route('admin.projects.drop', $project->id) }}"method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Cancella</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <h2 class="text-center mt-5">Non ci sono elementi nel cestino</h2>
                @endforelse
            </tbody>
        </table>

        <form action="{{ route('admin.projects.dropAll') }}"method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Cancella tutto</button>
        </form>
    </div>
@endsection
