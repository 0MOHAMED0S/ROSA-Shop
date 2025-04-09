<!-- Edit Modal -->
<div class="modal fade" id="editModal-{{ $number->id }}" tabindex="-1" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Numbers</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="{{ route('dashboard.numbers.update', $number->id) }}"
                    enctype="multipart/form-data" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <!-- Facebook Field -->
                        <div class="form-group row">
                            <label for="face"
                                class="col-sm-3 text-end control-label col-form-label">Facebook</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control @error('face') is-invalid @enderror"
                                    id="face" placeholder="Enter Facebook number" name="face"
                                    value="{{ old('face', $number->face) }}" />
                                @error('face')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Instagram Field -->
                        <div class="form-group row">
                            <label for="insta"
                                class="col-sm-3 text-end control-label col-form-label">Instagram</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control @error('insta') is-invalid @enderror"
                                    id="insta" placeholder="Enter Instagram number" name="insta"
                                    value="{{ old('insta', $number->insta) }}" />
                                @error('insta')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- TikTok Field -->
                        <div class="form-group row">
                            <label for="tik" class="col-sm-3 text-end control-label col-form-label">TikTok</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control @error('tik') is-invalid @enderror"
                                    id="tik" placeholder="Enter TikTok number" name="tik"
                                    value="{{ old('tik', $number->tik) }}" />
                                @error('tik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Orders Field -->
                        <div class="form-group row">
                            <label for="orders" class="col-sm-3 text-end control-label col-form-label">Orders</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control @error('orders') is-invalid @enderror"
                                    id="orders" placeholder="Enter Orders number" name="orders"
                                    value="{{ old('orders', $number->orders) }}" />
                                @error('orders')
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
