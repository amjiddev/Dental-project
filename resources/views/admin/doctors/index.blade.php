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
                                @if($doctor->is_active)
                                <span class="badge badge-light-success">Active</span>
                                @else
                                <span class="badge badge-light-danger">Inactive</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.doctors.edit', $doctor->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" title="Edit">
                                    <i class="ki-duotone ki-pencil fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </a>
                                <form action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this doctor?');">
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
