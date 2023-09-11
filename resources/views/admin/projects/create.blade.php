@extends('layouts.app')

@section('title', 'Create')

@section('content')

    <H1 class="text-center my-4">Aggiungi un nuovo proggetto</H1>
    <div class="container">
        @include('includes.projects.form')
    </div>

@endsection
@section('scripts')
    @vite('resources/js/preview-image.js')
@endsection
