<x-default-layout>

    @section('title')
        Gallery Management
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('admin.gallery.index') }}
    @endsection

    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <h3 class="fw-bold m-0">Gallery Items</h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('admin.gallery.create') }}" class="btn btn-sm btn-primary">
                    <i class="ki-duotone ki-plus fs-2"></i>
                    Add Gallery Item
                </a>
            </div>
        </div>

        <div class="card-body pt-0">
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <div class="table-responsive">
                <table class="table table-row-bordered table-row-gray-300 align-middle gs-0 gy-4">
                    <thead>
                        <tr class="fw-bold text-muted bg-light">
                            <th class="ps-4 min-w-40px">Order</th>
                            <th class="min-w-80px">Image</th>
                            <th class="min-w-150px">Title</th>
                            <th class="min-w-150px">Description</th>
                            <th class="min-w-80px">Status</th>
                            <th class="min-w-120px text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($gallery as $item)
                        <tr>
                            <td class="ps-4">
                                <span class="text-gray-800 fw-bold">{{ $item->order ?? '-' }}</span>
                            </td>
                            <td>
                                <div class="symbol symbol-50px">
                                    <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" />
                                </div>
                            </td>
                            <td>
                                <span class="text-gray-800 fw-bold">{{ $item->title }}</span>
                            </td>
                            <td>
                                <span class="text-muted">{{ Str::limit($item->description, 50) ?? '-' }}</span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm status-badge" data-gallery-id="{{ $item->id }}" style="border: none; background: none; padding: 0; cursor: pointer;">
                                    @if($item->is_active)
                                        <span class="badge badge-light-success">Active</span>
                                    @else
                                        <span class="badge badge-light-secondary">Inactive</span>
                                    @endif
                                </button>
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.gallery.edit', $item->id) }}" 
                                   class="btn btn-sm btn-primary me-2" title="Edit">
                                    <i class="ki-duotone ki-pencil fs-2"></i>
                                    Edit
                                </a>
                                <button type="button" 
                                        class="btn btn-sm btn-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $item->id }}"
                                        title="Delete">
                                    <i class="ki-duotone ki-trash fs-2"></i>
                                    Delete
                                </button>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete Gallery Item</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete this gallery item?</p>
                                                <p class="text-danger fw-bold">This action cannot be undone.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <form action="{{ route('admin.gallery.destroy', $item->id) }}" method="POST" style="display: inline;">
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
                            <td colspan="6" class="text-center py-5">
                                <p class="text-muted mb-0">No gallery items found.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($gallery->hasPages())
            <div class="d-flex justify-content-end">
                {{ $gallery->links() }}
            </div>
            @endif
        </div>
    </div>

</x-default-layout>

<script>
document.querySelectorAll('.status-badge').forEach(button => {
    button.addEventListener('click', function() {
        const galleryId = this.getAttribute('data-gallery-id');
        const badge = this.querySelector('.badge');
        
        // Show loading state
        const originalText = badge.textContent;
        badge.textContent = 'Loading...';
        
        fetch(`/admin/gallery/${galleryId}/toggle-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update badge color and text
                if (data.is_active) {
                    badge.classList.remove('badge-light-secondary');
                    badge.classList.add('badge-light-success');
                    badge.textContent = 'Active';
                } else {
                    badge.classList.remove('badge-light-success');
                    badge.classList.add('badge-light-secondary');
                    badge.textContent = 'Inactive';
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            badge.textContent = originalText;
            alert('Error updating status');
        });
    });
});
</script>
