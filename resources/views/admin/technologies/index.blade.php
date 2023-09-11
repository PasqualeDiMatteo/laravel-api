{{-- Extend admin --}}
@extends('layouts.app')

{{-- Titolo --}}
@section('title', 'Technologies')

{{-- Main --}}
@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary mt-4">
            {{ __('Dashboard') }}
        </h2>
        <div class="d-flex justify-content-end mb-3"><a href="{{ route('admin.technologies.create') }}"
                class="btn btn-success ">Aggiungi Tipo</a>
        </div>
        {{-- Table --}}
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Label</th>
                    <th scope="col">Colore</th>
                    <th scope="col">Data Creazione</th>
                    <th scope="col">Data Ultima Modifica</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($technologies as $technology)
                    <tr>
                        <th scope="row" class="align-middle">{{ $technology->id }}</th>
                        <td class="align-middle">{{ $technology->label }}</td>
                        <td class="align-middle">{{ $technology->color }}</td>
                        <td class="align-middle">{{ $technology->created_at }}</td>
                        <td class="align-middle">{{ $technology->updated_at }}</td>
                        <td>
                            <div class="d-flex justify-content-end gap-2 ">
                                <a href="{{ route('admin.technologies.show', $technology) }}"
                                    class="btn btn-primary btn-sm">Info</a>
                                <a href="{{ route('admin.technologies.edit', $technology) }}"
                                    class="btn btn-warning btn-sm">Modifica</a>

                                {{-- Button Modal --}}
                                <button type="button" class="btn btn-danger  btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#{{ $technology->id }}">
                                    Elimina
                                </button>
                                {{-- !!Modal --}}
                                @include('includes.technologies.modal-delete')
                            </div>
                        </td>
                    </tr>
                @empty
                    <td colspan="6">
                        <h3>Non ci sono progetti</h3>
                    </td>
                @endforelse
            </tbody>
        </table>
        {{-- !!Pagination --}}
        <a href="{{ route('admin.technologies.trash') }}">Cestino</a>
        @if ($technologies->hasPages())
            {{ $technologies->links() }}
        @endif
    </div>
@endsection
