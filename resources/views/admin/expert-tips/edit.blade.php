<x-default-layout>

    @section('title')
        Edit Expert Tip
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('admin.expert-tips.edit', $expertTip) }}
    @endsection

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Expert Tip</h3>
        </div>

        <form action="{{ route('admin.expert-tips.update', $expertTip->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
                            placeholder="e.g., Daily Skincare Routine" value="{{ old('title', $expertTip->title) }}" required />
                        @error('title')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label required fw-semibold fs-6">Category</label>
                    <div class="col-lg-9">
                        <input type="text" name="category" class="form-control form-control-lg @error('category') is-invalid @enderror" 
                            placeholder="e.g., SKINCARE" value="{{ old('category', $expertTip->category) }}" required />
                        @error('category')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label required fw-semibold fs-6">Description</label>
                    <div class="col-lg-9">
                        <textarea name="description" class="form-control form-control-lg @error('description') is-invalid @enderror" 
                            rows="5" placeholder="Detailed description of the expert tip" required>{{ old('description', $expertTip->description) }}</textarea>
                        @error('description')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Image</label>
                    <div class="col-lg-9">
                        @if($expertTip->image)
                        <div class="mb-3">
                            <img src="{{ asset($expertTip->image) }}" alt="{{ $expertTip->title }}" style="max-width: 200px; height: auto;" />
                        </div>
                        @endif
                        <input type="file" name="image" class="form-control form-control-lg @error('image') is-invalid @enderror" 
                            accept="image/*" />
                        <small class="d-block mt-2 text-muted">Leave empty to keep current image. Recommended size: 400x300px. Max size: 2MB</small>
                        @error('image')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Display Order</label>
                    <div class="col-lg-9">
                        <input type="number" name="order" class="form-control form-control-lg @error('order') is-invalid @enderror" 
                            placeholder="0" value="{{ old('order', $expertTip->order) }}" min="0" />
                        <small class="d-block mt-2 text-muted">Lower numbers appear first</small>
                        @error('order')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Status</label>
                    <div class="col-lg-9">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" 
                                id="is_active" {{ (old('is_active') === '1' || old('is_active') === 'on' || (is_null(old('is_active')) && $expertTip->is_active)) ? 'checked' : '' }} />
                            <label class="form-check-label" for="is_active">
                                Active (visible on frontend)
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end">
                <a href="{{ route('admin.expert-tips.index') }}" class="btn btn-secondary me-3">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <span class="indicator-label">Update Expert Tip</span>
                </button>
            </div>
        </form>
    </div>

</x-default-layout>
