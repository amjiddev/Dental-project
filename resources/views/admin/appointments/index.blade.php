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
                            <th class="ps-4 min-w-150px">Patient Name</th>
                            <th class="min-w-120px">Contact</th>
                            <th class="min-w-120px">Service</th>
                            <th class="min-w-120px">Doctor</th>
                            <th class="min-w-120px">Date & Time</th>
                            <th class="min-w-100px">Status</th>
                            <th class="min-w-200px text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($appointments as $appointment)
                        <tr id="appointment-row-{{ $appointment->id }}">
                            <td class="ps-4">
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
                                <span class="badge badge-light-{{ $color }}" id="status-badge-{{ $appointment->id }}">{{ ucfirst($appointment->status) }}</span>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex gap-2 justify-content-end">
                                    <button type="button" class="btn btn-sm btn-light-primary btn-view-appointment" data-id="{{ $appointment->id }}" title="View">
                                        View
                                    </button>
                                    <a href="{{ route('admin.appointments.edit', $appointment->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                        Edit
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger btn-delete-appointment" data-id="{{ $appointment->id }}" data-name="{{ $appointment->name }}" title="Delete">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-10">
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

    {{-- View / Handle Appointment Modal --}}
    <div class="modal fade" id="handleAppointmentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Handle Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    {{-- Appointment Info Card --}}
                    <div class="card bg-light mb-4">
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-6">
                                    <small class="text-muted d-block">Patient</small>
                                    <span class="fw-bold" id="modal-patient-name">-</span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Email</small>
                                    <span class="fw-semibold" id="modal-patient-email">-</span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Phone</small>
                                    <span class="fw-semibold" id="modal-patient-phone">-</span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Service</small>
                                    <span class="fw-semibold" id="modal-service">-</span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Doctor</small>
                                    <span class="fw-semibold" id="modal-doctor">-</span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Date & Time</small>
                                    <span class="fw-semibold" id="modal-datetime">-</span>
                                </div>
                                <div class="col-12" id="modal-message-wrap" style="display:none;">
                                    <small class="text-muted d-block">Message</small>
                                    <span id="modal-message" class="text-muted">-</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Handle Form --}}
                    <form id="handleAppointmentForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="handle-appointment-id" name="appointment_id">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Update Status</label>
                            <select class="form-select" id="handle-status" name="status" required>
                                <option value="pending">Pending</option>
                                <option value="confirmed">Confirmed</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Admin Notes</label>
                            <textarea class="form-control" id="handle-notes" name="admin_notes" rows="3" placeholder="Add notes about this appointment..."></textarea>
                        </div>

                        <div class="d-flex gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" id="btn-save-handle">
                                <span class="indicator-label">Save Changes</span>
                                <span class="indicator-progress" style="display:none;">
                                    Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <div class="modal fade" id="deleteAppointmentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <div class="mb-4">
                        <i class="ki-duotone ki-trash fs-5x text-danger">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                        </i>
                    </div>
                    <h5 class="fw-bold mb-2">Delete Appointment?</h5>
                    <p class="text-muted mb-4">Are you sure you want to delete <strong id="delete-appointment-name"></strong>? This action can be undone.</p>
                    <div class="d-flex gap-2 justify-content-center">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="btn-confirm-delete">
                            <span class="indicator-label">Yes, Delete</span>
                            <span class="indicator-progress" style="display:none;">
                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-hide success and alert messages after 5 seconds
        const alerts = document.querySelectorAll('.alert-success, .alert-danger, .alert-warning, .alert-info');
        alerts.forEach(function(alert) {
            setTimeout(function() {
                // Fade out effect
                alert.style.transition = 'opacity 0.5s ease-out';
                alert.style.opacity = '0';
                
                // Remove from DOM after fade
                setTimeout(function() {
                    alert.remove();
                }, 500);
            }, 5000); // 5 seconds
        });

        let deleteId = null;
        let handleId = null;

        // --- View / Handle Appointment ---
        document.querySelectorAll('.btn-view-appointment').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                handleId = id;

                fetch('{{ url("admin/appointments") }}/' + id + '/handle', {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    document.getElementById('handle-appointment-id').value = data.id;
                    document.getElementById('modal-patient-name').textContent = data.name;
                    document.getElementById('modal-patient-email').textContent = data.email;
                    document.getElementById('modal-patient-phone').textContent = data.phone;
                    document.getElementById('modal-service').textContent = data.service ? data.service.name : '-';
                    document.getElementById('modal-doctor').textContent = data.doctor ? data.doctor.name : 'Any Doctor';
                    document.getElementById('modal-datetime').textContent = data.appointment_date + ' | ' + data.appointment_time;

                    const msgWrap = document.getElementById('modal-message-wrap');
                    const msgEl = document.getElementById('modal-message');
                    if (data.message) {
                        msgEl.textContent = data.message;
                        msgWrap.style.display = 'block';
                    } else {
                        msgWrap.style.display = 'none';
                    }

                    document.getElementById('handle-status').value = data.status;
                    document.getElementById('handle-notes').value = data.admin_notes || '';

                    var modal = new bootstrap.Modal(document.getElementById('handleAppointmentModal'));
                    modal.show();
                })
                .catch(err => {
                    toastr.error('Failed to load appointment details.');
                });
            });
        });

        // --- Save Handle Form ---
        document.getElementById('handleAppointmentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const id = document.getElementById('handle-appointment-id').value;
            const status = document.getElementById('handle-status').value;
            const notes = document.getElementById('handle-notes').value;
            const btn = document.getElementById('btn-save-handle');

            btn.querySelector('.indicator-label').style.display = 'none';
            btn.querySelector('.indicator-progress').style.display = 'inline';
            btn.disabled = true;

            fetch('{{ url("admin/appointments") }}/' + id + '/handle', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ status: status, admin_notes: notes })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Update status badge in table
                    const badge = document.getElementById('status-badge-' + id);
                    if (badge) {
                        const colors = { pending: 'warning', confirmed: 'success', cancelled: 'danger', completed: 'info' };
                        badge.className = 'badge badge-light-' + (colors[status] || 'secondary');
                        badge.textContent = status.charAt(0).toUpperCase() + status.slice(1);
                    }
                    toastr.success(data.message);
                    bootstrap.Modal.getInstance(document.getElementById('handleAppointmentModal')).hide();
                } else {
                    toastr.error('Failed to update appointment.');
                }
            })
            .catch(err => {
                toastr.error('Failed to update appointment.');
            })
            .finally(() => {
                btn.querySelector('.indicator-label').style.display = 'inline';
                btn.querySelector('.indicator-progress').style.display = 'none';
                btn.disabled = false;
            });
        });

        // --- Delete Appointment ---
        document.querySelectorAll('.btn-delete-appointment').forEach(function(btn) {
            btn.addEventListener('click', function() {
                deleteId = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                document.getElementById('delete-appointment-name').textContent = name;
                var modal = new bootstrap.Modal(document.getElementById('deleteAppointmentModal'));
                modal.show();
            });
        });

        document.getElementById('btn-confirm-delete').addEventListener('click', function() {
            const btn = this;
            btn.querySelector('.indicator-label').style.display = 'none';
            btn.querySelector('.indicator-progress').style.display = 'inline';
            btn.disabled = true;

            fetch('{{ url("admin/appointments") }}/' + deleteId, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const row = document.getElementById('appointment-row-' + deleteId);
                    if (row) {
                        row.style.transition = 'opacity 0.3s ease';
                        row.style.opacity = '0';
                        setTimeout(() => row.remove(), 300);
                    }
                    toastr.success(data.message);
                    bootstrap.Modal.getInstance(document.getElementById('deleteAppointmentModal')).hide();
                } else {
                    toastr.error('Failed to delete appointment.');
                }
            })
            .catch(err => {
                toastr.error('Failed to delete appointment.');
            })
            .finally(() => {
                btn.querySelector('.indicator-label').style.display = 'inline';
                btn.querySelector('.indicator-progress').style.display = 'none';
                btn.disabled = false;
            });
        });
    });
    </script>
    @endpush

</x-default-layout>
