@extends('layouts.app')

@section('title', 'Projects')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary mt-4">
            {{ __('Dashboard') }}
        </h2>
        <div class="d-flex justify-content-end mb-3"><a href="{{ route('admin.projects.create') }}"
                class="btn btn-success ">Aggiungi Progetto</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Tecnologie</th>
                    <th scope="col">Link</th>
                    <th scope="col">Data Creazione</th>
                    <th scope="col">Data Ultima Modifica</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($projects as $project)
                    <tr>
                        <th scope="row" class="align-middle">{{ $project->id }}</th>
                        <td class="align-middle">{{ $project->title }}</td>
                        <td class="align-middle"><span
                                class="badge"style="background:{{ $project->type->color }}">{{ $project->type->label }}</span>
                        </td>
                        <td class="align-middle">
                            @forelse ($project->technologies as $technology)
                                <span class="badge rounded-pill bg-{{ $technology->color }}">{{ $technology->label }}</span>
                            @empty
                                -
                            @endforelse
                        </td>
                        <td class="align-middle"><a href="{{ $project->url }}">Apri in GitHub</a></td>
                        <td class="align-middle">{{ $project->created_at }}</td>
                        <td class="align-middle">{{ $project->updated_at }}</td>
                        <td>
                            <div class="d-flex justify-content-end gap-2 ">
                                <a href="{{ route('admin.projects.show', $project) }}"
                                    class="btn btn-primary btn-sm">Info</a>
                                <a href="{{ route('admin.projects.edit', $project) }}"
                                    class="btn btn-warning btn-sm">Modifica</a>
                                <button type="button" class="btn btn-danger  btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#{{ $project->id }}">
                                    Elimina
                                </button>
                                @include('includes.projects.modal-delete')
                            </div>
                        </td>
                    </tr>
                @empty
                    <td colspan="8">
                        <h3>Non ci sono progetti</h3>
                    </td>
                @endforelse
            </tbody>
        </table>
        <a href="{{ route('admin.projects.trash') }}">Cestino</a>
        @if ($projects->hasPages())
            {{ $projects->links() }}
        @endif
    </div>
@endsection
