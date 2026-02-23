<x-default-layout>

    @section('title')
        Edit Appointment
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('admin.appointments.edit', $appointment) }}
    @endsection

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Appointment #{{ $appointment->id }}</h3>
        </div>

        <form action="{{ route('admin.appointments.update', $appointment->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label required fw-bold fs-6">Patient Name</label>
                    <div class="col-lg-9">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $appointment->name) }}" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label required fw-bold fs-6">Email</label>
                    <div class="col-lg-9">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $appointment->email) }}" required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label required fw-bold fs-6">Phone</label>
                    <div class="col-lg-9">
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $appointment->phone) }}" required>
                        @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-bold fs-6">Service</label>
                    <div class="col-lg-9">
                        <select name="service_id" class="form-select @error('service_id') is-invalid @enderror">
                            <option value="">Select Service</option>
                            @foreach($services as $service)
                            <option value="{{ $service->id }}" {{ old('service_id', $appointment->service_id) == $service->id ? 'selected' : '' }}>
                                {{ $service->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('service_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-bold fs-6">Doctor</label>
                    <div class="col-lg-9">
                        <select name="doctor_id" class="form-select @error('doctor_id') is-invalid @enderror">
                            <option value="">Any Available Doctor</option>
                            @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}" {{ old('doctor_id', $appointment->doctor_id) == $doctor->id ? 'selected' : '' }}>
                                {{ $doctor->name }} - {{ $doctor->specialization }}
                            </option>
                            @endforeach
                        </select>
                        @error('doctor_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label required fw-bold fs-6">Appointment Date</label>
                    <div class="col-lg-9">
                        <input type="date" name="appointment_date" class="form-control @error('appointment_date') is-invalid @enderror" value="{{ old('appointment_date', $appointment->appointment_date->format('Y-m-d')) }}" required>
                        @error('appointment_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label required fw-bold fs-6">Appointment Time</label>
                    <div class="col-lg-9">
                        <input type="time" name="appointment_time" class="form-control @error('appointment_time') is-invalid @enderror" value="{{ old('appointment_time', $appointment->appointment_time) }}" required>
                        @error('appointment_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label required fw-bold fs-6">Status</label>
                    <div class="col-lg-9">
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="pending" {{ old('status', $appointment->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ old('status', $appointment->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="cancelled" {{ old('status', $appointment->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            <option value="completed" {{ old('status', $appointment->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-bold fs-6">Admin Notes</label>
                    <div class="col-lg-9">
                        <textarea name="admin_notes" class="form-control @error('admin_notes') is-invalid @enderror" rows="4">{{ old('admin_notes', $appointment->admin_notes) }}</textarea>
                        @error('admin_notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <a href="{{ route('admin.appointments.index') }}" class="btn btn-light btn-active-light-primary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>

</x-default-layout>
