{{-- Extend admin --}}
@extends('layouts.app')

{{-- Titolo --}}
@section('title', 'Create')

{{-- Main --}}
@section('content')

    <H1 class="text-center my-4">Aggiungi una nuova Tecnologia</H1>
    <div class="container">
        {{-- Form --}}
        @include('includes.technologies.form')
    </div>

@endsection
{{-- Scripts --}}
@section('scripts')
    @vite('resources/js/preview-image.js')
@endsection
