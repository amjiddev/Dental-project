<x-default-layout>

    @section('title')
        Expert Tips Management
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('admin.expert-tips.index') }}
    @endsection

    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <h3 class="fw-bold m-0">Expert Tips</h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('admin.expert-tips.create') }}" class="btn btn-sm btn-primary">
                    <i class="ki-duotone ki-plus fs-2"></i>
                    Add Expert Tip
                </a>
            </div>
        </div>

        <div class="card-body pt-0">
            <div class="table-responsive">
                <table class="table table-row-bordered table-row-gray-300 align-middle gs-0 gy-4">
                    <thead>
                        <tr class="fw-bold text-muted bg-light">
                            <th class="ps-4 min-w-50px">Order</th>
                            <th class="min-w-150px">Title</th>
                            <th class="min-w-120px">Category</th>
                            <th class="min-w-100px">Status</th>
                            <th class="min-w-120px text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tips as $tip)
                        <tr>
                            <td class="ps-4">
                                <span class="text-gray-800 fw-bold">{{ $tip->order ?? '-' }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($tip->image)
                                    <div class="symbol symbol-50px me-3">
                                        <img src="{{ asset($tip->image) }}" alt="{{ $tip->title }}" />
                                    </div>
                                    @endif
                                    <div class="d-flex flex-column">
                                        <span class="text-gray-800 fw-bold">{{ $tip->title }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-light-info">{{ $tip->category }}</span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm status-badge" data-tip-id="{{ $tip->id }}" style="border: none; background: none; padding: 0; cursor: pointer;">
                                    @if($tip->is_active)
                                    <span class="badge badge-light-success">Active</span>
                                    @else
                                    <span class="badge badge-light-danger">Inactive</span>
                                    @endif
                                </button>
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.expert-tips.edit', $tip->id) }}" 
                                   class="btn btn-sm btn-primary me-2" title="Edit">
                                    <i class="ki-duotone ki-pencil fs-2"></i>
                                    Edit
                                </a>
                                <button type="button" 
                                        class="btn btn-sm btn-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $tip->id }}"
                                        title="Delete">
                                    <i class="ki-duotone ki-trash fs-2"></i>
                                    Delete
                                </button>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $tip->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete Expert Tip</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete this expert tip?</p>
                                                <p class="text-danger fw-bold">This action cannot be undone.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <form action="{{ route('admin.expert-tips.destroy', $tip->id) }}" method="POST" style="display: inline;">
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
                            <td colspan="5" class="text-center py-10">
                                <div class="text-gray-600">No expert tips found</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-5">
                <div class="text-muted">
                    Showing {{ $tips->firstItem() ?? 0 }} to {{ $tips->lastItem() ?? 0 }} of {{ $tips->total() }} tips
                </div>
                <div>
                    {{ $tips->links() }}
                </div>
            </div>
        </div>
    </div>

</x-default-layout>

<script>
document.querySelectorAll('.status-badge').forEach(button => {
    button.addEventListener('click', function() {
        const tipId = this.getAttribute('data-tip-id');
        const badge = this.querySelector('.badge');
        const originalText = badge.textContent;
        badge.textContent = 'Loading...';
        
        fetch(`/admin/expert-tips/${tipId}/toggle-status`, {
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
