@extends('layouts.app')

@section('title', 'Edit')

@section('content')

    <H1 class="text-center my-4">Modifica la Tecnologia</H1>
    <div class="container">
        @include('includes.technologies.form')
    </div>

@endsection

@section('scripts')
    @vite('resources/js/preview-image.js')
@endsection
