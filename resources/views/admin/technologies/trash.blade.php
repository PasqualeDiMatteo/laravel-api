{{-- Extend admin --}}
@extends('layouts.app')

{{-- Titolo --}}
@section('title', 'Trash')

{{-- Main --}}
@section('content')
    {{-- Trash --}}
    <h1 class="text-center">Cestino</h1>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Label</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($technologies as $technology)
                    <tr>
                        <th scope="row">{{ $technology->id }}</th>
                        <td>{{ $technology->label }}</td>
                        <td>
                            <div class="d-flex justify-content-end gap-2">
                                {{-- Restore --}}
                                <form action="{{ route('admin.technologies.restore', $technology->id) }}"method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success">Ripristina</button>
                                </form>
                                {{-- Drop singol --}}
                                <form action="{{ route('admin.technologies.drop', $technology->id) }}"method="POST">
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
        {{-- Drop All --}}
        <form action="{{ route('admin.technologies.dropAll') }}"method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Cancella tutto</button>
        </form>
    </div>
@endsection
