<x-default-layout>

    @section('title')
        Appointments Management
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('admin.appointments.index') }}
    @endsection

    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <h3 class="fw-bold m-0">All Appointments</h3>
            </div>
            <div class="card-toolbar">
                <div class="d-flex gap-2">
                    <select class="form-select form-select-sm" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="card-body pt-0">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <div class="table-responsive">
                <table class="table table-row-bordered table-row-gray-300 align-middle gs-0 gy-4">
                    <thead>
                        <tr class="fw-bold text-muted bg-light">
                            <th class="ps-4 min-w-50px">ID</th>
                            <th class="min-w-150px">Patient Name</th>
                            <th class="min-w-150px">Contact</th>
                            <th class="min-w-120px">Service</th>
                            <th class="min-w-120px">Doctor</th>
                            <th class="min-w-120px">Date & Time</th>
                            <th class="min-w-100px">Status</th>
                            <th class="min-w-100px text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($appointments as $appointment)
                        <tr>
                            <td class="ps-4">
                                <span class="text-gray-800 fw-bold">#{{ $appointment->id }}</span>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="text-gray-800 fw-bold">{{ $appointment->name }}</span>
                                    <span class="text-muted fs-7">{{ $appointment->email }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="text-gray-800">{{ $appointment->phone }}</span>
                            </td>
                            <td>
                                @if($appointment->service)
                                <span class="badge badge-light-primary">{{ $appointment->service->name }}</span>
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($appointment->doctor)
                                <span class="text-gray-800">{{ $appointment->doctor->name }}</span>
                                @else
                                <span class="text-muted">Any Doctor</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="text-gray-800 fw-bold">{{ $appointment->appointment_date->format('M d, Y') }}</span>
                                    <span class="text-muted fs-7">{{ date('h:i A', strtotime($appointment->appointment_time)) }}</span>
                                </div>
                            </td>
                            <td>
                                @php
                                    $statusColors = [
                                        'pending' => 'warning',
                                        'confirmed' => 'success',
                                        'cancelled' => 'danger',
                                        'completed' => 'info'
                                    ];
                                    $color = $statusColors[$appointment->status] ?? 'secondary';
                                @endphp
                                <span class="badge badge-light-{{ $color }}">{{ ucfirst($appointment->status) }}</span>
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.appointments.show', $appointment->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" title="View">
                                    <i class="ki-duotone ki-eye fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </a>
                                <a href="{{ route('admin.appointments.edit', $appointment->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" title="Edit">
                                    <i class="ki-duotone ki-pencil fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </a>
                                <form action="{{ route('admin.appointments.destroy', $appointment->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this appointment?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm" title="Delete">
                                        <i class="ki-duotone ki-trash fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                        </i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-10">
                                <div class="text-gray-600">No appointments found</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-5">
                <div class="text-muted">
                    Showing {{ $appointments->firstItem() ?? 0 }} to {{ $appointments->lastItem() ?? 0 }} of {{ $appointments->total() }} appointments
                </div>
                <div>
                    {{ $appointments->links() }}
                </div>
            </div>
        </div>
    </div>

</x-default-layout>
