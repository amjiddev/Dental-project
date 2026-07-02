<div class="menu menu-column menu-rounded menu-sub-indention px-3 fw-semibold fs-6" id="#kt_app_sidebar_menu"
    data-kt-menu="true" data-kt-menu-expand="false">
    
    <!--begin:Menu item - Dashboard-->
    <div class="menu-item">
        <a class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <span class="menu-icon">{!! getIcon('element-11', 'fs-2') !!}</span>
            <span class="menu-title">Dashboard</span>
        </a>
    </div>
    <!--end:Menu item-->

    <!--begin:Menu item - Appointments-->
    <div class="menu-item">
        <a class="menu-link {{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}" href="{{ route('admin.appointments.index') }}">
            <span class="menu-icon">{!! getIcon('calendar', 'fs-2') !!}</span>
            <span class="menu-title">Appointments</span>
        </a>
    </div>
    <!--end:Menu item-->

    <!--begin:Menu item - Services-->
    <div class="menu-item">
        <a class="menu-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}" href="{{ route('admin.services.index') }}">
            <span class="menu-icon">{!! getIcon('medical-cross', 'fs-2') !!}</span>
            <span class="menu-title">Services</span>
        </a>
    </div>
    <!--end:Menu item-->

    <!--begin:Menu item - Doctors-->
    <div class="menu-item">
        <a class="menu-link {{ request()->routeIs('admin.doctors.*') ? 'active' : '' }}" href="{{ route('admin.doctors.index') }}">
            <span class="menu-icon">{!! getIcon('profile-user', 'fs-2') !!}</span>
            <span class="menu-title">Doctors</span>
        </a>
    </div>
    <!--end:Menu item-->

</div>
