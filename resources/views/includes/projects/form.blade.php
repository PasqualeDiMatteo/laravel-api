@if ($project->exists)
    <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
    @else
        <form action="{{ route('admin.projects.store') }}" method="POST"enctype="multipart/form-data">
@endif
@csrf
<div class="row">
    <div class="col-6">
        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                name="title" value="{{ old('title', $project->title) }}">
            <div class="invalid-feedback">
                {{ $errors->first('title') }}
            </div>
        </div>
    </div>
    <div class="col-5">
        <div class="mb-3">
            <label for="image" class="form-label">Immagine</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                name="image" value="{{ old('image', $project->image) }}">
            <div class="invalid-feedback">
                {{ $errors->first('image') }}
            </div>
        </div>
    </div>
    <div class="col-1">
        <div class="mb-3">
            <img src="{{ $project->image ? asset('storage/' . $project->image) : 'https://marcolanci.it/utils/placeholder.jpg' }}"
                alt="preview" class="img-fluid" id="preview">
        </div>
    </div>
    <div class="col-6">
        <div class="mb-3">
            <label for="url" class="form-label">Link Progetto</label>
            <input type="url" class="form-control @error('url') is-invalid @enderror" id="url" name="url"
                value="{{ old('url', $project->url) }}">
            <div class="invalid-feedback">
                {{ $errors->first('url') }}
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="mb-3">
            <label for="type" class="form-label">Tipo</label>
            <select class="form-select @error('type_id') is-invalid @enderror" id="type" name="type_id">
                <option selected>Nessuno</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" @if (old('type_id', $project->type_id) == $type->id) selected @endif>
                        {{ $type->label }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                {{ $errors->first('type_id') }}
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Descrizione" id="description"
                name="description">{{ old('description', $project->description) }}</textarea>
            <label for="description">Descrizione</label>
            <div class="invalid-feedback">
                {{ $errors->first('description') }}
            </div>
        </div>
    </div>
    <div class="col-9">
        <h6 class="mt-5">Tecnologie</h6>
        @foreach ($technologies as $technology)
            <div class="form-check form-check-inline mt-3">
                <label class="form-check-label" for="tech-{{ $technology->id }}">{{ $technology->label }}</label>
                <input class="form-check-input   @error('technology') is-invalid @enderror" type="checkbox"
                    id="tech-{{ $technology->id }}" @if (in_array($technology->id, old('technology', $project_technology_ids ?? []))) checked @endif
                    value="{{ $technology->id }} "name="technology[]">
            </div>
        @endforeach
        @error('technology')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-12 d-flex justify-content-end mt-3">
        <button type="reset" class="btn btn-primary me-2">Reset</button>
        <button class="btn btn-success">Aggiungi</button>
    </div>
</div>
</form>
