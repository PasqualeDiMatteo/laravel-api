{{-- Layouts --}}
@extends('layouts.guest')
{{-- Title --}}
@section('title', 'Home')
{{-- Cdns --}}
@section('cdns')
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css'
        integrity='sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=='
        crossorigin='anonymous' />
@endsection
{{-- Main --}}
@section('content')
    <div class="row h-100 m-0">
        {{-- Left side --}}
        <div class="col-6 h-100 jumbotron">
            {{-- Jumbotron --}}
            <div class="  p-5 rounded-3 h-100">
                <div class="content-jumbotron">
                    <h1 class="typing-demo">Hi,I'm Pasquale</h1>
                    <p>I am Junior Full Stack Web Developer.</p>
                </div>
            </div>
        </div>
        {{-- Right side --}}
        <div class="col-6 h-100 bg-yellow">
            {{-- Card Logo --}}
            <div class="row card-logo text-center">
                <div class="col-12">
                    <img src="{{ Vite::asset('resources/img/logo.png') }}" alt="Logo" class="img-fluid logo">
                </div>
                <div class="col-12 mt-3"><a href="#work" class="btn btn-outline-dark btn-lg">See My Work</a></div>
            </div>
        </div>
    </div>
    </div>
@endsection
