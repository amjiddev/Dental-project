<x-default-layout>

    @section('title')
        Services Management
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('admin.services.index') }}
    @endsection

    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <h3 class="fw-bold m-0">All Services</h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('admin.services.create') }}" class="btn btn-sm btn-primary">
                    <i class="ki-duotone ki-plus fs-2"></i>
                    Add Service
                </a>
            </div>
        </div>

        <div class="card-body pt-0">
            <div class="table-responsive">
                <table class="table table-row-bordered table-row-gray-300 align-middle gs-0 gy-4">
                    <thead>
                        <tr class="fw-bold text-muted bg-light">
                            <th class="min-w-200px">Service </th>
                            <th class="min-w-150px">Name</th>
                            <th class="min-w-100px">Description</th>
                            <th class="min-w-100px">Status</th>
                            <th class="min-w-100px text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $service)
                        <tr>

                            <td>
                                <div class="d-flex align-items-center">
                                    @if($service->image)
                                    <div class="symbol symbol-50px me-3">
                                        <img src="{{ asset($service->image) }}" alt="{{ $service->name }}" />
                                    </div>
                                    @endif
                                    <div class="d-flex flex-column">
                                        

                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-gray-800 fw-bold">{{ $service->name }}</span>
                            </td>
                            <td>
                                        @if($service->short_description)
                                        <span class="text-muted fs-7">{{ Str::limit($service->short_description, 50) }}</span>
                                        @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm status-badge" data-service-id="{{ $service->id }}" style="border: none; background: none; padding: 0; cursor: pointer;">
                                    @if($service->is_active)
                                    <span class="badge badge-light-success">Active</span>
                                    @else
                                    <span class="badge badge-light-danger">Inactive</span>
                                    @endif
                                </button>
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.services.treatment-options.index', $service->id) }}"
                                   class="btn btn-sm btn-light-primary me-2" title="Treatment Options">
                                    Treatments
                                </a>
                                <a href="{{ route('admin.services.edit', $service->id) }}" 
                                   class="btn btn-sm btn-primary me-2" title="Edit">
                                    <i class="ki-duotone ki-pencil fs-2"></i>
                                    Edit
                                </a>
                                <button type="button" 
                                        class="btn btn-sm btn-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $service->id }}"
                                        title="Delete">
                                    <i class="ki-duotone ki-trash fs-2"></i>
                                    Delete
                                </button>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $service->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete Service</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete this service?</p>
                                                <p class="text-danger fw-bold">This action cannot be undone.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" style="display: inline;">
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
                            <td colspan="6" class="text-center py-10">
                                <div class="text-gray-600">No services found</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-5">
                <div class="text-muted">
                    Showing {{ $services->firstItem() ?? 0 }} to {{ $services->lastItem() ?? 0 }} of {{ $services->total() }} services
                </div>
                <div>
                    {{ $services->links() }}
                </div>
            </div>
        </div>
    </div>

</x-default-layout>

<script>
document.querySelectorAll('.status-badge').forEach(button => {
    button.addEventListener('click', function() {
        const serviceId = this.getAttribute('data-service-id');
        const badge = this.querySelector('.badge');
        const originalText = badge.textContent;
        badge.textContent = 'Loading...';
        
        fetch(`/admin/services/${serviceId}/toggle-status`, {
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
