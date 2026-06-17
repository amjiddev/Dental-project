<x-default-layout>

    @section('title')
        Treatment Options - {{ $service->name }}
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('admin.services.treatment-options.index', $service) }}
    @endsection

    <div class="card mb-5">
        <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <h3 class="fw-bold mb-1">{{ $service->name }}</h3>
                <p class="text-muted mb-0">Manage treatment options shown on the service page.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-light-primary">
                    Edit Service Details
                </a>
                <a href="{{ route('admin.services.treatment-options.create', $service) }}" class="btn btn-primary">
                    <i class="ki-duotone ki-plus fs-2"></i>
                    Add Treatment Option
                </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <h3 class="fw-bold m-0">Treatment Options</h3>
            </div>
        </div>

        <div class="card-body pt-0">
            <div class="table-responsive">
                <table class="table table-row-bordered table-row-gray-300 align-middle gs-0 gy-4">
                    <thead>
                        <tr class="fw-bold text-muted bg-light">
                            <th class="ps-4 min-w-50px">Order</th>
                            <th class="min-w-80px">Image</th>
                            <th class="min-w-200px">Name</th>
                            <th class="min-w-250px">Description</th>
                            <th class="min-w-100px">Status</th>
                            <th class="min-w-100px text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($treatmentOptions as $option)
                        <tr>
                            <td class="ps-4">
                                <span class="text-gray-800 fw-bold">{{ $option->order ?? '-' }}</span>
                            </td>
                            <td>
                                @if($option->image)
                                <div class="symbol symbol-50px">
                                    <img src="{{ asset($option->image) }}" alt="{{ $option->name }}" />
                                </div>
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="text-gray-800 fw-bold">{{ $option->name }}</span>
                            </td>
                            <td>
                                <span class="text-muted">{{ Str::limit($option->description, 80) ?: '-' }}</span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm status-badge" data-treatment-option-id="{{ $option->id }}" style="border: none; background: none; padding: 0; cursor: pointer;">
                                    @if($option->is_active)
                                    <span class="badge badge-light-success">Active</span>
                                    @else
                                    <span class="badge badge-light-danger">Inactive</span>
                                    @endif
                                </button>
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.services.treatment-options.edit', [$service, $option]) }}"
                                   class="btn btn-sm btn-primary me-2">
                                    Edit
                                </a>
                                <button type="button"
                                        class="btn btn-sm btn-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $option->id }}">
                                    Delete
                                </button>

                                <div class="modal fade" id="deleteModal{{ $option->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete Treatment Option</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete <strong>{{ $option->name }}</strong>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <form action="{{ route('admin.services.treatment-options.destroy', [$service, $option]) }}" method="POST" style="display: inline;">
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
                                <div class="text-gray-600 mb-3">No treatment options yet.</div>
                                <a href="{{ route('admin.services.treatment-options.create', $service) }}" class="btn btn-sm btn-primary">
                                    Add First Treatment Option
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($treatmentOptions->hasPages())
            <div class="d-flex justify-content-end mt-5">
                {{ $treatmentOptions->links() }}
            </div>
            @endif
        </div>
    </div>

@push('scripts')
<script>
document.querySelectorAll('.status-badge').forEach(button => {
    button.addEventListener('click', function() {
        const treatmentOptionId = this.getAttribute('data-treatment-option-id');
        const badge = this.querySelector('.badge');
        const originalText = badge.textContent;
        badge.textContent = 'Loading...';

        fetch(`/admin/services/{{ $service->id }}/treatment-options/${treatmentOptionId}/toggle-status`, {
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
@endpush

</x-default-layout>
