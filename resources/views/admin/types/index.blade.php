{{-- Extend admin --}}
@extends('layouts.app')

{{-- Titolo --}}
@section('title', 'Types')

{{-- Main --}}
@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary mt-4">
            {{ __('Dashboard') }}
        </h2>
        <div class="d-flex justify-content-end mb-3"><a href="{{ route('admin.types.create') }}"
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
                @forelse ($types as $type)
                    <tr>
                        <th scope="row" class="align-middle">{{ $type->id }}</th>
                        <td class="align-middle">{{ $type->label }}</td>
                        <td class="align-middle">{{ $type->color }}</td>
                        <td class="align-middle">{{ $type->created_at }}</td>
                        <td class="align-middle">{{ $type->updated_at }}</td>
                        <td>
                            <div class="d-flex justify-content-end gap-2 ">
                                <a href="{{ route('admin.types.show', $type) }}" class="btn btn-primary btn-sm">Info</a>
                                <a href="{{ route('admin.types.edit', $type) }}" class="btn btn-warning btn-sm">Modifica</a>

                                {{-- Button Modal --}}
                                <button type="button" class="btn btn-danger  btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#{{ $type->id }}">
                                    Elimina
                                </button>
                                {{-- Modal --}}
                                @include('includes.types.modal-delete')
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
        {{-- Pagination --}}
        <a href="{{ route('admin.types.trash') }}">Cestino</a>
        @if ($types->hasPages())
            {{ $types->links() }}
        @endif
    </div>
@endsection
