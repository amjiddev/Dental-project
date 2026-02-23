<x-default-layout>

    @section('title')
        Appointment Details
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('admin.appointments.show', $appointment) }}
    @endsection

    <div class="row g-5">
        <div class="col-xl-8">
            <div class="card mb-5">
                <div class="card-header">
                    <h3 class="card-title">Appointment Information</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-7">
                        <label class="col-lg-4 fw-bold text-muted">Appointment ID</label>
                        <div class="col-lg-8">
                            <span class="fw-bold fs-6 text-gray-800">#{{ $appointment->id }}</span>
                        </div>
                    </div>

                    <div class="row mb-7">
                        <label class="col-lg-4 fw-bold text-muted">Patient Name</label>
                        <div class="col-lg-8">
                            <span class="fw-bold fs-6 text-gray-800">{{ $appointment->name }}</span>
                        </div>
                    </div>

                    <div class="row mb-7">
                        <label class="col-lg-4 fw-bold text-muted">Email</label>
                        <div class="col-lg-8">
                            <a href="mailto:{{ $appointment->email }}" class="fw-bold fs-6 text-gray-800 text-hover-primary">{{ $appointment->email }}</a>
                        </div>
                    </div>

                    <div class="row mb-7">
                        <label class="col-lg-4 fw-bold text-muted">Phone</label>
                        <div class="col-lg-8">
                            <a href="tel:{{ $appointment->phone }}" class="fw-bold fs-6 text-gray-800 text-hover-primary">{{ $appointment->phone }}</a>
                        </div>
                    </div>

                    <div class="row mb-7">
                        <label class="col-lg-4 fw-bold text-muted">Service</label>
                        <div class="col-lg-8">
                            @if($appointment->service)
                            <span class="badge badge-light-primary fs-6">{{ $appointment->service->name }}</span>
                            @else
                            <span class="text-muted">Not specified</span>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-7">
                        <label class="col-lg-4 fw-bold text-muted">Preferred Doctor</label>
                        <div class="col-lg-8">
                            @if($appointment->doctor)
                            <span class="fw-bold fs-6 text-gray-800">{{ $appointment->doctor->name }}</span>
                            @else
                            <span class="text-muted">Any available doctor</span>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-7">
                        <label class="col-lg-4 fw-bold text-muted">Appointment Date</label>
                        <div class="col-lg-8">
                            <span class="fw-bold fs-6 text-gray-800">{{ $appointment->appointment_date->format('F d, Y') }}</span>
                        </div>
                    </div>

                    <div class="row mb-7">
                        <label class="col-lg-4 fw-bold text-muted">Appointment Time</label>
                        <div class="col-lg-8">
                            <span class="fw-bold fs-6 text-gray-800">{{ date('h:i A', strtotime($appointment->appointment_time)) }}</span>
                        </div>
                    </div>

                    @if($appointment->message)
                    <div class="row mb-7">
                        <label class="col-lg-4 fw-bold text-muted">Message</label>
                        <div class="col-lg-8">
                            <span class="fw-semibold fs-6 text-gray-600">{{ $appointment->message }}</span>
                        </div>
                    </div>
                    @endif

                    @if($appointment->admin_notes)
                    <div class="row mb-7">
                        <label class="col-lg-4 fw-bold text-muted">Admin Notes</label>
                        <div class="col-lg-8">
                            <span class="fw-semibold fs-6 text-gray-600">{{ $appointment->admin_notes }}</span>
                        </div>
                    </div>
                    @endif

                    <div class="row mb-7">
                        <label class="col-lg-4 fw-bold text-muted">Created At</label>
                        <div class="col-lg-8">
                            <span class="fw-semibold fs-6 text-gray-600">{{ $appointment->created_at->format('M d, Y h:i A') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card mb-5">
                <div class="card-header">
                    <h3 class="card-title">Status</h3>
                </div>
                <div class="card-body">
                    @php
                        $statusColors = [
                            'pending' => 'warning',
                            'confirmed' => 'success',
                            'cancelled' => 'danger',
                            'completed' => 'info'
                        ];
                        $color = $statusColors[$appointment->status] ?? 'secondary';
                    @endphp
                    <div class="mb-5">
                        <span class="badge badge-light-{{ $color }} fs-4">{{ ucfirst($appointment->status) }}</span>
                    </div>

                    @if(Route::has('admin.appointments.status'))
                    <form action="{{ route('admin.appointments.status', $appointment->id) }}" method="POST">
                        @csrf
                        <label class="form-label fw-bold">Update Status</label>
                        <select name="status" class="form-select mb-3">
                            <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        <button type="submit" class="btn btn-primary w-100">Update Status</button>
                    </form>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Actions</h3>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.appointments.edit', $appointment->id) }}" class="btn btn-light-primary w-100 mb-3">
                        <i class="ki-duotone ki-pencil fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        Edit Appointment
                    </a>
                    <form action="{{ route('admin.appointments.destroy', $appointment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this appointment?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-light-danger w-100">
                            <i class="ki-duotone ki-trash fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                            Delete Appointment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-default-layout>
