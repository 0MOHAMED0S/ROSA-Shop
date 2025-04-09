<!-- Edit Modal -->
<div class="modal fade" id="editModal-{{ $shipping->id }}" tabindex="-1" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Shipping Cost</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="{{ route('dashboard.shipping.update', $shipping->id) }}"
                    enctype="multipart/form-data" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <!-- cost Field -->
                        <div class="form-group row">
                            <label for="face"
                                class="col-sm-3 text-end control-label col-form-label">Cost</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control @error('cost') is-invalid @enderror"
                                    id="face" placeholder="Enter the cost " name="cost"
                                    value="{{ old('cost', $shipping->cost) }}" />
                                @error('cost')
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
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
