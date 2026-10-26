<x-default-layout>

    @section('title')
        Add Gallery Item
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('admin.gallery.create') }}
    @endsection

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add New Gallery Item</h3>
        </div>

        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label required fw-semibold fs-6">Title</label>
                    <div class="col-lg-9">
                        <input type="text" name="title" class="form-control form-control-lg @error('title') is-invalid @enderror" 
                            placeholder="Enter gallery item title" value="{{ old('title') }}" required />
                        @error('title')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Description</label>
                    <div class="col-lg-9">
                        <textarea name="description" class="form-control form-control-lg @error('description') is-invalid @enderror" 
                            rows="4" placeholder="Enter description">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label required fw-semibold fs-6">Image</label>
                    <div class="col-lg-9">
                        <div class="input-group">
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" 
                                accept="image/*" required onchange="previewImage(event)" />
                        </div>
                        @error('image')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="d-block mt-2 text-muted">Allowed formats: JPEG, PNG, JPG, GIF, WebP (Max: 2MB)</small>
                        
                        <!-- Image Preview -->
                        <div id="imagePreview" class="mt-3" style="display: none;">
                            <img id="previewImg" src="" alt="Preview" class="img-fluid rounded" style="max-width: 300px; max-height: 300px;">
                        </div>
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Display Order</label>
                    <div class="col-lg-9">
                        <input type="number" name="order" class="form-control form-control-lg @error('order') is-invalid @enderror" 
                            placeholder="0" value="{{ old('order', 0) }}" min="0" />
                        @error('order')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="d-block mt-2 text-muted">Lower numbers appear first in the gallery</small>
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Status</label>
                    <div class="col-lg-9">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" 
                                id="is_active" checked />
                            <label class="form-check-label" for="is_active">
                                Active (visible on frontend)
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end">
                <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary me-3">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <span class="indicator-label">Add Gallery Item</span>
                </button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImg').src = e.target.result;
                    document.getElementById('imagePreview').style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }
    </script>

</x-default-layout>
