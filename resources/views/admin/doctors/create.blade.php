<x-default-layout>

    @section('title')
        Add New Doctor
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('admin.doctors.create') }}
    @endsection

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add New Doctor</h3>
        </div>

        <form action="{{ route('admin.doctors.store') }}" method="POST" enctype="multipart/form-data">
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
                    <label class="col-lg-3 col-form-label required fw-semibold fs-6">Doctor Name</label>
                    <div class="col-lg-9">
                        <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" 
                            placeholder="Enter doctor name" value="{{ old('name') }}" required />
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label required fw-semibold fs-6">Specialization</label>
                    <div class="col-lg-9">
                        <input type="text" name="specialization" class="form-control form-control-lg @error('specialization') is-invalid @enderror" 
                            placeholder="e.g., Orthodontist, Endodontist" value="{{ old('specialization') }}" required />
                        @error('specialization')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Qualification</label>
                    <div class="col-lg-9">
                        <input type="text" name="qualification" class="form-control form-control-lg @error('qualification') is-invalid @enderror" 
                            placeholder="e.g., BDS, MDS" value="{{ old('qualification') }}" />
                        @error('qualification')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Bio</label>
                    <div class="col-lg-9">
                        <textarea name="bio" class="form-control form-control-lg @error('bio') is-invalid @enderror" 
                            rows="5" placeholder="Doctor's biography and experience">{{ old('bio') }}</textarea>
                        @error('bio')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Profile Image</label>
                    <div class="col-lg-9">
                        <input type="file" name="image" class="form-control form-control-lg @error('image') is-invalid @enderror" 
                            accept="image/*" />
                        @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Recommended size: 400x400px (square)</div>
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Email</label>
                    <div class="col-lg-9">
                        <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                            placeholder="doctor@example.com" value="{{ old('email') }}" />
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Phone</label>
                    <div class="col-lg-9">
                        <input type="text" name="phone" class="form-control form-control-lg @error('phone') is-invalid @enderror" 
                            placeholder="+1 234 567 8900" value="{{ old('phone') }}" />
                        @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Experience (Years)</label>
                    <div class="col-lg-9">
                        <input type="number" name="experience_years" class="form-control form-control-lg @error('experience_years') is-invalid @enderror" 
                            placeholder="5" min="0" value="{{ old('experience_years') }}" />
                        @error('experience_years')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Display Order</label>
                    <div class="col-lg-9">
                        <input type="number" name="order" class="form-control form-control-lg @error('order') is-invalid @enderror" 
                            placeholder="0" min="0" value="{{ old('order', 0) }}" />
                        @error('order')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Lower numbers appear first</div>
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Status</label>
                    <div class="col-lg-9">
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" 
                                {{ (old('is_active') === '1' || old('is_active') === 'on' || is_null(old('is_active'))) ? 'checked' : '' }} />
                            <label class="form-check-label" for="is_active">
                                Active
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Lead Doctor</label>
                    <div class="col-lg-9">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" name="is_lead_doctor" id="is_lead_doctor" 
                                {{ old('is_lead_doctor') === '1' || old('is_lead_doctor') === 'on' ? 'checked' : '' }} />
                            <label class="form-check-label" for="is_lead_doctor">
                                Make this the lead doctor (only one can be set)
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <a href="{{ route('admin.doctors.index') }}" class="btn btn-light btn-active-light-primary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Doctor</button>
            </div>
        </form>
    </div>

</x-default-layout>
