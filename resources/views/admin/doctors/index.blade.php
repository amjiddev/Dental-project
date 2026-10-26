<x-default-layout>

    @section('title')
        Doctors Management
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('admin.doctors.index') }}
    @endsection

    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <h3 class="fw-bold m-0">All Doctors</h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('admin.doctors.create') }}" class="btn btn-sm btn-primary">
                    <i class="ki-duotone ki-plus fs-2"></i>
                    Add Doctor
                </a>
            </div>
        </div>

        <div class="card-body pt-0">
            <div class="table-responsive">
                <table class="table table-row-bordered table-row-gray-300 align-middle gs-0 gy-4">
                    <thead>
                        <tr class="fw-bold text-muted bg-light">
                            <th class="ps-4 min-w-50px">Order</th>
                            <th class="min-w-250px">Doctor</th>
                            <th class="min-w-150px">Specialization</th>
                            <th class="min-w-150px">Contact</th>
                            <th class="min-w-100px">Experience</th>
                            <th class="min-w-100px">Status</th>
                            <th class="min-w-100px text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($doctors as $doctor)
                        <tr>
                            <td class="ps-4">
                                <span class="text-gray-800 fw-bold">{{ $doctor->order ?? '-' }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-50px me-3">
                                        @if($doctor->image)
                                        <img src="{{ asset($doctor->image) }}" alt="{{ $doctor->name }}" />
                                        @else
                                        <div class="symbol-label fs-3 bg-light-primary text-primary">
                                            {{ substr($doctor->name, 0, 1) }}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="text-gray-800 fw-bold">{{ $doctor->name }}</span>
                                        @if($doctor->qualification)
                                        <span class="text-muted fs-7">{{ $doctor->qualification }}</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-light-info">{{ $doctor->specialization }}</span>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    @if($doctor->email)
                                    <span class="text-gray-800 fs-7">{{ $doctor->email }}</span>
                                    @endif
                                    @if($doctor->phone)
                                    <span class="text-muted fs-7">{{ $doctor->phone }}</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if($doctor->experience_years)
                                <span class="text-gray-800">{{ $doctor->experience_years }} years</span>
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm status-badge" data-doctor-id="{{ $doctor->id }}" style="border: none; background: none; padding: 0; cursor: pointer;">
                                    @if($doctor->is_active)
                                    <span class="badge badge-light-success">Active</span>
                                    @else
                                    <span class="badge badge-light-danger">Inactive</span>
                                    @endif
                                </button>
                                @if($doctor->is_lead_doctor)
                                <span class="badge badge-light-warning ms-1">Lead</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.doctors.edit', $doctor->id) }}" 
                                   class="btn btn-sm btn-primary me-2" title="Edit">
                                    <i class="ki-duotone ki-pencil fs-2"></i>
                                    Edit
                                </a>
                                <button type="button" 
                                        class="btn btn-sm btn-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $doctor->id }}"
                                        title="Delete">
                                    <i class="ki-duotone ki-trash fs-2"></i>
                                    Delete
                                </button>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $doctor->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete Doctor</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete this doctor?</p>
                                                <p class="text-danger fw-bold">This action cannot be undone.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <form action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-10">
                                <div class="text-gray-600">No doctors found</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-5">
                <div class="text-muted">
                    Showing {{ $doctors->firstItem() ?? 0 }} to {{ $doctors->lastItem() ?? 0 }} of {{ $doctors->total() }} doctors
                </div>
                <div>
                    {{ $doctors->links() }}
                </div>
            </div>
        </div>
    </div>

</x-default-layout>

<script>
document.querySelectorAll('.status-badge').forEach(button => {
    button.addEventListener('click', function() {
        const doctorId = this.getAttribute('data-doctor-id');
        const badge = this.querySelector('.badge');
        const originalText = badge.textContent;
        badge.textContent = 'Loading...';
        
        fetch(`/admin/doctors/${doctorId}/toggle-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (data.is_active) {
                    badge.classList.remove('badge-light-danger');
                    badge.classList.add('badge-light-success');
                    badge.textContent = 'Active';
                } else {
                    badge.classList.remove('badge-light-success');
                    badge.classList.add('badge-light-danger');
                    badge.textContent = 'Inactive';
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            badge.textContent = originalText;
        });
    });
});
</script>
