<!-- Edit Modal -->
<div class="modal fade" id="editModal-{{ $product->id }}" tabindex="-1" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="{{ route('dashboard.products.update', $product->id) }}"
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
                                    value="{{ old('name', $product->name) }}" />
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Section Dropdown -->
                        <div class="form-group row">
                            <label for="section_id"
                                class="col-sm-3 text-end control-label col-form-label">Section</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('section_id') is-invalid @enderror" name="section_id"
                                    id="section_id">
                                    <option value="">Select a Section</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}"
                                            {{ old('section_id', $product->section_id) == $section->id ? 'selected' : '' }}>
                                            {{ $section->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('section_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Price Field (Decimal Support) -->
                        <div class="form-group row">
                            <label for="price" class="col-sm-3 text-end control-label col-form-label">Price</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control @error('price') is-invalid @enderror"
                                    id="price" placeholder="Price here" name="price"
                                    value="{{ old('price', $product->price) }}" step="0.01" min="0" />
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Discount Field (Whole Numbers Only) -->
                        <div class="form-group row">
                            <label for="discount"
                                class="col-sm-3 text-end control-label col-form-label">Discount</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control @error('discount') is-invalid @enderror"
                                    id="discount" placeholder="Enter discount amount" name="discount"
                                    value="{{ old('discount', $product->discount) }}" min="0" step="1" />
                                @error('discount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <!-- Description Field -->
                        <div class="form-group row">
                            <label for="description"
                                class="col-sm-3 text-end control-label col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                                    placeholder="Enter product description" name="description" rows="4">{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Image Upload -->
                        <div class="form-group row">
                            <label for="image" class="col-sm-3 text-end control-label col-form-label">Image</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control @error('path') is-invalid @enderror"
                                    id="image" name="path" accept="image/*" onchange="previewImage(event)" />
                                @error('path')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <!-- Show existing image -->
                                <div class="mt-3">
                                    <img id="imagePreview"
                                        src="{{ $product->path ? asset('storage/' . $product->path) : '' }}"
                                        alt="Current Image" class="img-thumbnail {{ $product->path ? '' : 'd-none' }}"
                                        width="120">
                                </div>
                            </div>
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
<!-- JavaScript for Image Preview -->
<script>
    function previewImage(event) {
        var image = document.getElementById('imagePreview');
        var file = event.target.files[0];

        if (file) {
            var reader = new FileReader();
            reader.onload = function() {
                image.src = reader.result;
                image.classList.remove("d-none"); // Show preview
            };
            reader.readAsDataURL(file);
        }
    }
</script>
