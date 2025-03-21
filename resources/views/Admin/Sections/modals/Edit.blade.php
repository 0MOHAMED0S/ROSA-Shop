<!-- Edit Modal -->
<div class="modal fade" id="editModal-{{ $section->id }}" tabindex="-1" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="{{ route('dashboard.sections.update', $section->id) }}"
                    enctype="multipart/form-data" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <!-- Name Field -->
                        <div class="form-group row">
                            <label for="Name" class="col-sm-3 text-end control-label col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="Name" placeholder="Name Here" name="name"
                                    value="{{ old('name', $section->name) }}" />
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    <!-- Submit Button -->
                    <div class="border-top">
                        <div class="card-body text-center">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>