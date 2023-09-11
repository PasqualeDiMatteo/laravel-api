@extends('layouts.app')

@section('title', 'Edit')

@section('content')

    <H1 class="text-center my-4">Modifica il Tipo</H1>
    <div class="container">
        @include('includes.types.form')
    </div>

@endsection

@section('scripts')
    @vite('resources/js/preview-image.js')
@endsection
