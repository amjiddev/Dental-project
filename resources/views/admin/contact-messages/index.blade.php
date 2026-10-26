<x-default-layout>

    @section('title')
        Contact Messages
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('admin.contact-messages.index') }}
    @endsection

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle fs-2 me-3"></i>
                <div>
                    <strong>Success!</strong> {{ session('success') }}
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-header border-bottom border-gray-200 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-envelope fs-2 text-primary"></i>
                        <h3 class="fw-bold m-0">Contact Messages
                            @if($unreadCount > 0)
                            <span class="badge badge-light-danger ms-2">{{ $unreadCount }} New</span>
                            @endif
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body pt-6">
            @if($messages->count() > 0)
            <div class="table-responsive">
                <table class="table table-row-bordered table-row-gray-300 align-middle gs-0 gy-4">
                    <thead>
                        <tr class="fw-bold text-muted bg-light">
                            <th class="ps-4 min-w-50px">
                                <input type="checkbox" class="form-check-input" id="selectAll">
                            </th>
                            <th class="min-w-200px">Sender</th>
                            <th class="min-w-200px">Subject</th>
                            <th class="min-w-150px">Date</th>
                            <th class="min-w-100px">Status</th>
                            <th class="min-w-150px text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $message)
                        <tr class="{{ $message->is_read ? '' : 'table-active' }}">
                            <td class="ps-4">
                                <input type="checkbox" class="form-check-input message-checkbox" value="{{ $message->id }}">
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-45px bg-light-primary me-3">
                                        <span class="symbol-label text-primary fw-bold">
                                            {{ strtoupper(substr($message->name, 0, 1)) }}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="text-dark fw-bold">
                                            {{ $message->name }}
                                        </span>
                                        <div class="text-muted small">{{ $message->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="fw-bold">
                                    {{ Str::limit($message->subject, 50) }}
                                </span>
                            </td>
                            <td>
                                <span class="text-muted">{{ $message->created_at->format('M d, Y h:i A') }}</span>
                            </td>
                            <td>
                                @if($message->is_read)
                                    <span class="badge badge-light-info">Read</span>
                                @else
                                    <span class="badge badge-light-danger">Unread</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <button type="button" 
                                        class="btn btn-sm btn-primary me-2"
                                        data-bs-toggle="modal"
                                        data-bs-target="#messageModal{{ $message->id }}"
                                        data-message-id="{{ $message->id }}"
                                        data-message-name="{{ $message->name }}"
                                        data-message-email="{{ $message->email }}"
                                        data-message-phone="{{ $message->phone }}"
                                        data-message-subject="{{ $message->subject }}"
                                        data-message-content="{{ $message->message }}"
                                        data-message-date="{{ $message->created_at->format('F d, Y h:i A') }}">
                                    <i class="fas fa-eye"></i>
                                    View
                                </button>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $message->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <!-- View Message Modal -->
                                <div class="modal fade" id="messageModal{{ $message->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header border-bottom pb-3">
                                                <div>
                                                    <h5 class="modal-title fw-bold">{{ $message->subject }}</h5>
                                                    <small class="text-muted">From: {{ $message->name }} ({{ $message->email }})</small>
                                                </div>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-muted">Name</label>
                                                    <p class="text-dark">{{ $message->name }}</p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-muted">Email</label>
                                                    <p class="text-dark"><a href="mailto:{{ $message->email }}">{{ $message->email }}</a></p>
                                                </div>
                                                @if($message->phone)
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-muted">Phone</label>
                                                    <p class="text-dark"><a href="tel:{{ $message->phone }}">{{ $message->phone }}</a></p>
                                                </div>
                                                @endif
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-muted">Subject</label>
                                                    <p class="text-dark">{{ $message->subject }}</p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-muted">Message</label>
                                                    <div class="bg-light p-3 rounded">
                                                        <p class="text-dark mb-0">{{ nl2br(e($message->message)) }}</p>
                                                    </div>
                                                </div>
                                                <div class="mb-0">
                                                    <label class="form-label fw-bold text-muted">Received</label>
                                                    <p class="text-muted small mb-0">{{ $message->created_at->format('F d, Y \a\t h:i A') }}</p>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-top pt-3">
                                                <a href="mailto:{{ $message->email }}?subject=Re: {{ urlencode($message->subject) }}" class="btn btn-outline-primary">
                                                    <i class="fas fa-reply me-1"></i>Reply via Email
                                                </a>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $message->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header border-0 pb-0">
                                                <h5 class="modal-title">Delete Message</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete this message from <strong>{{ $message->name }}</strong>?</p>
                                                <p class="text-muted small">This action cannot be undone.</p>
                                            </div>
                                            <div class="modal-footer border-0 pt-0">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <form action="{{ route('admin.contact-messages.destroy', $message) }}" method="POST" style="display: inline;">
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
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $messages->links() }}
            </div>
            @else
            <div class="text-center py-10">
                <div class="mb-3">
                    <i class="fas fa-inbox fs-4x text-muted"></i>
                </div>
                <h4 class="fw-bold text-muted mb-2">No Messages Yet</h4>
                <p class="text-muted mb-0">No contact messages have been received yet. They will appear here when someone fills out the contact form.</p>
            </div>
            @endif
        </div>
    </div>

</x-default-layout>

@push('scripts')
<script>
// Auto-hide success and alert messages after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
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
});

console.log('Contact Messages Script Loaded - Outside DOMContentLoaded');

function markMessageAsRead(messageId) {
    const url = `/admin/contact-messages/${messageId}/mark-as-read`;
    console.log('Fetching URL:', url);
    
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        console.log('Response ok:', response.ok);
        if (!response.ok) {
            throw new Error('Network response was not ok: ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        if (data.success) {
            console.log('Message marked as read successfully, reloading page...');
            // Reload the page to reflect changes
            setTimeout(() => {
                location.reload();
            }, 800);
        } else {
            console.log('Mark as read failed, data:', data);
        }
    })
    .catch(error => {
        console.error('Full error object:', error);
        console.error('Error marking message as read:', error.message);
    });
}

// Auto-mark messages as read when modal is shown
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM Content Loaded');
    
    // Use event delegation - listen for all clicks
    document.addEventListener('click', function(e) {
        // Check if clicked element or parent has data-bs-toggle and data-message-id
        const button = e.target.closest('[data-message-id]');
        
        if (button && button.getAttribute('data-bs-toggle') === 'modal') {
            const messageId = button.getAttribute('data-message-id');
            console.log('🔵 View button clicked for message ID:', messageId);
            
            // Wait for modal to open then mark as read
            setTimeout(() => {
                markMessageAsRead(messageId);
            }, 300);
        }
    });
    
    console.log('Event listener attached successfully');
});
</script>
@endpush
