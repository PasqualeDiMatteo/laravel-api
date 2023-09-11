{{-- Se esiste type --}}
@if ($type->exists)
    <form action="{{ route('admin.types.update', $type) }}" method="POST">
        @method('PUT')
        {{-- Altrimenti --}}
    @else
        <form action="{{ route('admin.types.store') }}" method="POST">
@endif
@csrf
<div class="row">
    {{-- Label --}}
    <div class="col-6">
        <div class="mb-3">
            <label for="label" class="form-label">Label</label>
            <input type="text" class="form-control @error('label') is-invalid @enderror" id="label" name="label"
                value="{{ old('label', $type->label) }}">
            <div class="invalid-feedback">
                {{ $errors->first('label') }}
            </div>
        </div>
    </div>
    {{-- Color --}}
    <div class="col-2 ">
        <div class="mb-3">
            <label for="color" class="form-label">Colore</label>
            <input type="color" name="color"
                class="form-control form-control-color @error('color') is-invalid @enderror" id="color"
                value="{{ old('color', $type->color) }}">
            <div class="invalid-feedback">
                {{ $errors->first('color') }}
            </div>
        </div>
    </div>
    {{-- Buttons --}}
    <div class="col-12 d-flex align-items-center justify-content-start mt-3">
        <button type="reset" class="btn btn-primary me-2">Reset</button>
        <button class="btn btn-success">Aggiungi</button>
    </div>
</div>
</form>
