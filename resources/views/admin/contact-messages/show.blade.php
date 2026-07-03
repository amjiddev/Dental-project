<x-default-layout>

    @section('title')
        Message from {{ $contactMessage->name }}
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('admin.contact-messages.show', $contactMessage) }}
    @endsection

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header border-bottom border-gray-200 pt-6">
                    <div class="card-title">
                        <div class="d-flex align-items-center gap-3">
                            <div class="symbol symbol-60px bg-light-primary">
                                <span class="symbol-label text-primary fw-bold fs-2">
                                    {{ strtoupper(substr($contactMessage->name, 0, 1)) }}
                                </span>
                            </div>
                            <div>
                                <h3 class="fw-bold m-0">{{ $contactMessage->name }}</h3>
                                <p class="text-muted mb-0">{{ $contactMessage->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body pt-6">
                    <!-- Message Details -->
                    <div class="mb-6">
                        <h4 class="fw-bold mb-2">Subject</h4>
                        <p class="text-dark mb-0">{{ $contactMessage->subject }}</p>
                    </div>

                    @if($contactMessage->phone)
                    <div class="mb-6">
                        <h4 class="fw-bold mb-2">Phone Number</h4>
                        <p class="text-dark mb-0">
                            <a href="tel:{{ $contactMessage->phone }}">{{ $contactMessage->phone }}</a>
                        </p>
                    </div>
                    @endif

                    <div class="mb-6">
                        <h4 class="fw-bold mb-2">Message</h4>
                        <div class="bg-light p-4 rounded">
                            <p class="text-dark mb-0 line-height-lg">{{ nl2br(e($contactMessage->message)) }}</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h4 class="fw-bold mb-2">Received On</h4>
                        <p class="text-dark mb-0">{{ $contactMessage->created_at->format('F d, Y \a\t h:i A') }}</p>
                    </div>

                    <!-- Actions -->
                    <div class="d-flex gap-2 pt-4 border-top">
                        <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-light btn-lg">
                            <i class="ki-duotone ki-arrow-left fs-2"></i>
                            Back to Messages
                        </a>
                        <button type="button" class="btn btn-danger btn-lg" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="ki-duotone ki-trash fs-2"></i>
                            Delete Message
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header border-bottom border-gray-200 pt-6">
                    <h5 class="card-title fw-bold">Contact Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <label class="fw-bold text-muted mb-2">Name</label>
                        <p class="text-dark">{{ $contactMessage->name }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="fw-bold text-muted mb-2">Email</label>
                        <p class="text-dark">
                            <a href="mailto:{{ $contactMessage->email }}">{{ $contactMessage->email }}</a>
                        </p>
                    </div>
                    @if($contactMessage->phone)
                    <div class="mb-4">
                        <label class="fw-bold text-muted mb-2">Phone</label>
                        <p class="text-dark">
                            <a href="tel:{{ $contactMessage->phone }}">{{ $contactMessage->phone }}</a>
                        </p>
                    </div>
                    @endif
                    <div>
                        <label class="fw-bold text-muted mb-2">Received</label>
                        <p class="text-dark">{{ $contactMessage->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header border-bottom border-gray-200 pt-6">
                    <h5 class="card-title fw-bold">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <a href="mailto:{{ $contactMessage->email }}?subject=Re: {{ urlencode($contactMessage->subject) }}" class="btn btn-outline-primary w-100 mb-2">
                        <i class="ki-duotone ki-sms me-2"></i>
                        Reply via Email
                    </a>
                    <a href="tel:{{ str_replace([' ', '-', '(', ')'], '', $contactMessage->phone ?? '') }}" class="btn btn-outline-success w-100 mb-2" @if(!$contactMessage->phone) disabled @endif>
                        <i class="ki-duotone ki-call me-2"></i>
                        Call Sender
                    </a>
                    <button type="button" class="btn btn-outline-danger w-100" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <i class="ki-duotone ki-trash me-2"></i>
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title">Delete Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this message from <strong>{{ $contactMessage->name }}</strong>?</p>
                    <p class="text-muted small">This action cannot be undone. All message content will be permanently deleted.</p>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.contact-messages.destroy', $contactMessage) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-default-layout>
