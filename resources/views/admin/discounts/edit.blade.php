<x-default-layout>

    @section('title')
        Edit Discount
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('admin.discounts.edit', $discount) }}
    @endsection

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Discount</h3>
        </div>

        <form action="{{ route('admin.discounts.update', $discount->id) }}" method="POST">
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
                            placeholder="e.g., New Patient Special" value="{{ old('title', $discount->title) }}" required />
                        @error('title')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label required fw-semibold fs-6">Discount Percentage</label>
                    <div class="col-lg-9">
                        <input type="number" name="discount_percentage" class="form-control form-control-lg @error('discount_percentage') is-invalid @enderror" 
                            placeholder="e.g., 20" value="{{ old('discount_percentage', $discount->discount_percentage) }}" min="1" max="100" required />
                        @error('discount_percentage')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label required fw-semibold fs-6">Card Color</label>
                    <div class="col-lg-9">
                        <input type="color" name="color" class="form-control form-control-lg @error('color') is-invalid @enderror" 
                            value="{{ old('color', $discount->color) }}" required />
                        <small class="d-block mt-2 text-muted">Choose the color for the discount card header</small>
                        @error('color')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Description</label>
                    <div class="col-lg-9">
                        <textarea name="description" class="form-control form-control-lg @error('description') is-invalid @enderror" 
                            rows="3" placeholder="Brief description">{{ old('description', $discount->description) }}</textarea>
                        @error('description')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Benefits</label>
                    <div class="col-lg-9">
                        <textarea name="benefits" class="form-control form-control-lg @error('benefits') is-invalid @enderror" 
                            rows="5" placeholder="Enter each benefit on a new line">{{ old('benefits', $discount->benefits ? implode("\n", $discount->benefits) : '') }}</textarea>
                        <small class="d-block mt-2 text-muted">Enter each benefit on a new line</small>
                        @error('benefits')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Button Label</label>
                    <div class="col-lg-9">
                        <input type="text" name="button_label" class="form-control form-control-lg @error('button_label') is-invalid @enderror" 
                            placeholder="e.g., Book Now" value="{{ old('button_label', $discount->button_label) }}" />
                        @error('button_label')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Button Link</label>
                    <div class="col-lg-9">
                        <input type="url" name="button_link" class="form-control form-control-lg @error('button_link') is-invalid @enderror" 
                            placeholder="https://example.com" value="{{ old('button_link', $discount->button_link) }}" />
                        @error('button_link')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Status</label>
                    <div class="col-lg-9">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" 
                                id="is_active" {{ $discount->is_active ? 'checked' : '' }} />
                            <label class="form-check-label" for="is_active">
                                Active (visible on frontend)
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end">
                <a href="{{ route('admin.discounts.index') }}" class="btn btn-secondary me-3">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <span class="indicator-label">Update Discount</span>
                </button>
            </div>
        </form>
    </div>

</x-default-layout>
