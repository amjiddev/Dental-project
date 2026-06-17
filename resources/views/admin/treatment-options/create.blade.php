<x-default-layout>

    @section('title')
        Add Treatment Option - {{ $service->name }}
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('admin.services.treatment-options.create', $service) }}
    @endsection

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Treatment Option for {{ $service->name }}</h3>
        </div>

        <form action="{{ route('admin.services.treatment-options.store', $service) }}" method="POST" enctype="multipart/form-data">
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
                    <label class="col-lg-3 col-form-label required fw-semibold fs-6">Treatment Name</label>
                    <div class="col-lg-9">
                        <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror"
                            placeholder="e.g. Dental Fillings" value="{{ old('name') }}" required />
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Description</label>
                    <div class="col-lg-9">
                        <textarea name="description" class="form-control form-control-lg @error('description') is-invalid @enderror"
                            rows="4" placeholder="Describe this treatment option">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Treatment Image</label>
                    <div class="col-lg-9">
                        <input type="file" name="image" class="form-control form-control-lg @error('image') is-invalid @enderror"
                            accept="image/*" />
                        @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Recommended size: 600x400px</div>
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Status</label>
                    <div class="col-lg-9">
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                                {{ old('is_active', true) ? 'checked' : '' }} />
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <a href="{{ route('admin.services.treatment-options.index', $service) }}" class="btn btn-light btn-active-light-primary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Treatment Option</button>
            </div>
        </form>
    </div>

</x-default-layout>
