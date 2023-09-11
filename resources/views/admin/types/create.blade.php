{{-- Extend admin --}}
@extends('layouts.app')

{{-- Titolo --}}
@section('title', 'Create')

{{-- Main --}}
@section('content')

    <H1 class="text-center my-4">Aggiungi un nuovo Tipo</H1>
    <div class="container">
        {{-- Form --}}
        @include('includes.types.form')
    </div>

@endsection
{{-- Scripts --}}
@section('scripts')
    @vite('resources/js/preview-image.js')
@endsection
