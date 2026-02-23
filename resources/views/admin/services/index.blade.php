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
                            <th class="ps-4 min-w-50px">Order</th>
                            <th class="min-w-200px">Service Name</th>
                            <th class="min-w-150px">Price</th>
                            <th class="min-w-100px">Duration</th>
                            <th class="min-w-100px">Status</th>
                            <th class="min-w-100px text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $service)
                        <tr>
                            <td class="ps-4">
                                <span class="text-gray-800 fw-bold">{{ $service->order ?? '-' }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($service->image)
                                    <div class="symbol symbol-50px me-3">
                                        <img src="{{ asset($service->image) }}" alt="{{ $service->name }}" />
                                    </div>
                                    @endif
                                    <div class="d-flex flex-column">
                                        <span class="text-gray-800 fw-bold">{{ $service->name }}</span>
                                        @if($service->short_description)
                                        <span class="text-muted fs-7">{{ Str::limit($service->short_description, 50) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($service->price)
                                <span class="text-gray-800 fw-bold">${{ number_format($service->price, 2) }}</span>
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($service->duration_minutes)
                                <span class="text-gray-800">{{ $service->duration_minutes }} min</span>
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($service->is_active)
                                <span class="badge badge-light-success">Active</span>
                                @else
                                <span class="badge badge-light-danger">Inactive</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" title="Edit">
                                    <i class="ki-duotone ki-pencil fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </a>
                                <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this service?');">
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
