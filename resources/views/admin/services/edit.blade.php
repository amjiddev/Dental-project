<x-default-layout>

    @section('title')
        Edit Service
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('admin.services.edit', $service) }}
    @endsection

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Service: {{ $service->name }}</h3>
        </div>

        <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
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
                    <label class="col-lg-3 col-form-label required fw-semibold fs-6">Service Name</label>
                    <div class="col-lg-9">
                        <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" 
                            placeholder="Enter service name" value="{{ old('name', $service->name) }}" required />
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Short Description</label>
                    <div class="col-lg-9">
                        <textarea name="short_description" class="form-control form-control-lg @error('short_description') is-invalid @enderror" 
                            rows="2" placeholder="Brief description (max 500 characters)">{{ old('short_description', $service->short_description) }}</textarea>
                        @error('short_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Full Description</label>
                    <div class="col-lg-9">
                        <textarea name="description" class="form-control form-control-lg @error('description') is-invalid @enderror" 
                            rows="5" placeholder="Detailed description for the About This Service section">{{ old('description', $service->description) }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                @include('admin.services._page-content-fields', ['service' => $service])

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Icon Class</label>
                    <div class="col-lg-9">
                        <input type="text" name="icon" class="form-control form-control-lg @error('icon') is-invalid @enderror" 
                            placeholder="e.g., fas fa-tooth" value="{{ old('icon', $service->icon) }}" />
                        @error('icon')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">FontAwesome icon class (e.g., fas fa-tooth, fas fa-teeth)</div>
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Service Image</label>
                    <div class="col-lg-9">
                        @if($service->image)
                        <div class="mb-3">
                            <img src="{{ asset($service->image) }}" alt="{{ $service->name }}" class="img-thumbnail" style="max-width: 200px;" />
                        </div>
                        @endif
                        <input type="file" name="image" class="form-control form-control-lg @error('image') is-invalid @enderror" 
                            accept="image/*" />
                        @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Leave empty to keep current image. Recommended size: 800x600px</div>
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Status</label>
                    <div class="col-lg-9">
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" 
                                {{ old('is_active', $service->is_active) ? 'checked' : '' }} />
                            <label class="form-check-label" for="is_active">
                                Active
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <a href="{{ route('admin.services.index') }}" class="btn btn-light btn-active-light-primary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Service</button>
            </div>
        </form>
    </div>

</x-default-layout>
