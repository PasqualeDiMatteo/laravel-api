{{-- Se esiste type --}}
@if ($technology->exists)
    <form action="{{ route('admin.technologies.update', $technology) }}" method="POST">
        @method('PUT')
        {{-- Altrimenti --}}
    @else
        <form action="{{ route('admin.technologies.store') }}" method="POST">
@endif
@csrf
<div class="row aligh-items-center">
    {{-- Label --}}
    <div class="col-6">
        <div class="mb-3">
            <label for="label" class="form-label">Label</label>
            <input type="text" class="form-control @error('label') is-invalid @enderror" id="label" name="label"
                value="{{ old('label', $technology->label) }}">
            <div class="invalid-feedback">
                {{ $errors->first('label') }}
            </div>
        </div>
    </div>

    {{-- Color --}}
    <div class="col-6 ">
        <label for="label" class="form-label">Colore</label>
        <select class="form-select" aria-label="Default select example" name="color">
            <option selected>Nessuno</option>
            @foreach ($colors as $color)
                <option value="{{ $color['color'] }}" @if (old('color', $technology->color == $color['color'])) selected @endif>
                    {{ $color['info'] }}</option>
            @endforeach
        </select>
    </div>
    {{-- Buttons --}}
    <div class="col-12 d-flex align-items-center justify-content-start mt-3">
        <button type="reset" class="btn btn-primary me-2">Reset</button>
        <button class="btn btn-success">Aggiungi</button>
    </div>
</div>
</form>
