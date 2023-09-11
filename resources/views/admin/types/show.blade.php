{{-- Extend admin --}}
@extends('layouts.app')

{{-- Titolo --}}
@section('title', $type->label)

{{-- Main --}}
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5 ">
            <div class="col-8">
                {{-- Card --}}
                <div class="card mb-3 py-2">
                    <div class="row g-0 justify-content-center">
                        <div class=" col-10 ">
                            <div class="card-body">
                                <h5 class="card-title">{{ $type->label }}</h5>
                                <p class="card-text">{{ $type->color }}</p>
                                <p class="card-text">Creato il: <small
                                        class="text-body-secondary">{{ $type->created_at }}</small>
                                </p>
                                <p class="card-text">Ultima modifica: <small
                                        class="text-body-secondary">{{ $type->updated_at }}</small>
                                </p>
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.types.index') }}" class="btn btn-secondary">Torna indietro</a>
                                    {{-- Button Modal --}}
                                    <button type="button" class="btn btn-danger  btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#{{ $type->id }}">
                                        Elimina
                                    </button>
                                    {{-- Modal --}}
                                    @include('includes.types.modal-delete')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
