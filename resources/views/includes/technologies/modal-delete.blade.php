<!-- Modal -->
<div class="modal fade" id="{{ $technology->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Attenzione!!</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Sicuro di voler cancellare <strong>{{ $technology->label }}</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="{{ route('admin.technologies.destroy', $technology) }}" method="POST"
                    class="delete-form"data-title="{{ $technology->label }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Elimina</button>
                </form>
            </div>
        </div>
    </div>
</div>
