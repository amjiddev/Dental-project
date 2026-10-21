<x-default-layout>

    @section('title')
        My Profile
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('profile') }}
    @endsection

    <div class="card mb-5 mb-xl-10">
        <!--begin::Card header-->
        <div class="card-header border-0 cursor-pointer" role="button">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">Profile Details</h3>
            </div>
            <!--end::Card title-->

            <!--begin::Action-->
            <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-primary align-self-center">
                Edit Profile
            </a>
            <!--end::Action-->
        </div>
        <!--begin::Card header-->

        <!--begin::Card body-->
        <div class="card-body border-top p-9">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-semibold text-muted">Profile Photo</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8">
                    <div class="d-flex align-items-center">
                        @if($user->profile_photo_url)
                            <div class="symbol symbol-100px me-5">
                                <img src="{{ $user->profile_photo_url }}" alt="Profile Photo"/>
                            </div>
                        @else
                            <div class="symbol symbol-100px me-5">
                                <div class="symbol-label fs-2 fw-semibold {{ app(\App\Actions\GetThemeType::class)->handle('bg-light-? text-?', $user->name) }}">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-semibold text-muted">Full Name</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{ $user->name }}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-semibold text-muted">Email</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8">
                    <span class="fw-semibold text-gray-800 fs-6">{{ $user->email }}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-semibold text-muted">Email Verified</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8">
                    @if($user->email_verified_at)
                        <span class="badge badge-success">Verified</span>
                    @else
                        <span class="badge badge-warning">Not Verified</span>
                    @endif
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-semibold text-muted">Member Since</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8">
                    <span class="fw-semibold text-gray-800 fs-6">{{ $user->created_at->format('F d, Y') }}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->

            @if($user->last_login_at)
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-semibold text-muted">Last Login</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8">
                    <span class="fw-semibold text-gray-800 fs-6">{{ $user->last_login_at->format('F d, Y h:i A') }}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            @endif

            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-semibold text-muted">Roles</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8">
                    @forelse($user->getRoleNames() as $role)
                        <span class="badge badge-primary me-1">{{ ucfirst(str_replace('_', ' ', $role)) }}</span>
                    @empty
                        <span class="text-muted">No roles assigned</span>
                    @endforelse
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Card body-->
    </div>

</x-default-layout>
