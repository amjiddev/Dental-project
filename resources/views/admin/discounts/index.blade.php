<x-default-layout>

    @section('title')
        Discount Management
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('admin.discounts.index') }}
    @endsection

    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <h3 class="fw-bold m-0">Discounts</h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('admin.discounts.create') }}" class="btn btn-sm btn-primary">
                    <i class="ki-duotone ki-plus fs-2"></i>
                    Add Discount
                </a>
            </div>
        </div>

        <div class="card-body pt-0">
            <div class="table-responsive">
                <table class="table table-row-bordered table-row-gray-300 align-middle gs-0 gy-4">
                    <thead>
                        <tr class="fw-bold text-muted bg-light">
                            <th class="ps-4 min-w-80px">Discount %</th>
                            <th class="min-w-80px">Color</th>
                            <th class="min-w-150px">Title</th>
                            <th class="min-w-100px">Status</th>
                            <th class="min-w-120px text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($discounts as $discount)
                        <tr>
                            <td class="ps-4">
                                <span class="badge badge-light-info">{{ $discount->discount_percentage }}%</span>
                            </td>
                            <td>
                                <div class="symbol symbol-40px">
                                    <div style="width: 40px; height: 40px; background-color: {{ $discount->color }}; border-radius: 4px; border: 2px solid #ddd;"></div>
                                </div>
                            </td>
                            <td>
                                <span class="text-gray-800 fw-bold">{{ $discount->title }}</span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm status-badge" data-discount-id="{{ $discount->id }}" style="border: none; background: none; padding: 0; cursor: pointer;">
                                    @if($discount->is_active)
                                        <span class="badge badge-light-success">Active</span>
                                    @else
                                        <span class="badge badge-light-secondary">Inactive</span>
                                    @endif
                                </button>
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.discounts.edit', $discount->id) }}" 
                                   class="btn btn-sm btn-primary me-2" title="Edit">
                                    <i class="ki-duotone ki-pencil fs-2"></i>
                                    Edit
                                </a>
                                <button type="button" 
                                        class="btn btn-sm btn-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $discount->id }}"
                                        title="Delete">
                                    <i class="ki-duotone ki-trash fs-2"></i>
                                    Delete
                                </button>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $discount->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete Discount</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete this discount?</p>
                                                <p class="text-danger fw-bold">This action cannot be undone.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <form action="{{ route('admin.discounts.destroy', $discount->id) }}" method="POST" style="display: inline;">
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
                            <td colspan="5" class="text-center py-5">
                                <p class="text-muted mb-0">No discounts found.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($discounts->hasPages())
            <div class="d-flex justify-content-end">
                {{ $discounts->links() }}
            </div>
            @endif
        </div>
    </div>

</x-default-layout>

<script>
document.querySelectorAll('.status-badge').forEach(button => {
    button.addEventListener('click', function() {
        const discountId = this.getAttribute('data-discount-id');
        const badge = this.querySelector('.badge');
        const originalText = badge.textContent;
        badge.textContent = 'Loading...';
        
        fetch(`/admin/discounts/${discountId}/toggle-status`, {
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
        });
    });
});
</script>
