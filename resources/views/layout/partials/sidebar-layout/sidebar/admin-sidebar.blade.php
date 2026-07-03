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
    <div data-kt-menu-trigger="click"
        class="menu-item menu-accordion {{ request()->routeIs('admin.services.*') ? 'here show' : '' }}">
        <span class="menu-link">
            <span class="menu-icon">{!! getIcon('medical-cross', 'fs-2') !!}</span>
            <span class="menu-title">Services</span>
            <span class="menu-arrow"></span>
        </span>

        <div class="menu-sub menu-sub-accordion">
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin.services.index') || request()->routeIs('admin.services.create') ? 'active' : '' }}"
                    href="{{ route('admin.services.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">All Services</span>
                </a>
            </div>

            @foreach($sidebarServices as $service)
            <div class="menu-item">
                <a class="menu-link {{ (request()->routeIs('admin.services.treatment-options.*') || request()->routeIs('admin.services.edit')) && optional(request()->route('service'))->id === $service->id ? 'active' : '' }}"
                    href="{{ route('admin.services.treatment-options.index', $service->id) }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{ $service->name }}</span>
                </a>
            </div>
            @endforeach
        </div>
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

    <!--begin:Menu item - Gallery-->
    <div class="menu-item">
        <a class="menu-link {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}" href="{{ route('admin.gallery.index') }}">
            <span class="menu-icon">{!! getIcon('image', 'fs-2') !!}</span>
            <span class="menu-title">Gallery</span>
        </a>
    </div>
    <!--end:Menu item-->

    <!--begin:Menu item - Discounts-->
    <div class="menu-item">
        <a class="menu-link {{ request()->routeIs('admin.discounts.*') ? 'active' : '' }}" href="{{ route('admin.discounts.index') }}">
            <span class="menu-icon">{!! getIcon('discount', 'fs-2') !!}</span>
            <span class="menu-title">Discounts</span>
        </a>
    </div>
    <!--end:Menu item-->

    <!--begin:Menu item - Expert Tips-->
    <div class="menu-item">
        <a class="menu-link {{ request()->routeIs('admin.expert-tips.*') ? 'active' : '' }}" href="{{ route('admin.expert-tips.index') }}">
            <span class="menu-icon">{!! getIcon('lightbulb', 'fs-2') !!}</span>
            <span class="menu-title">Expert Tips</span>
        </a>
    </div>
    <!--end:Menu item-->

    <!--begin:Menu item - About Us-->
    <div class="menu-item">
        <a class="menu-link {{ request()->routeIs('admin.settings.about') ? 'active' : '' }}" href="{{ route('admin.settings.about') }}">
            <span class="menu-icon">{!! getIcon('information-5', 'fs-2') !!}</span>
            <span class="menu-title">About Us</span>
        </a>
    </div>
    <!--end:Menu item-->

    <!--begin:Menu item - Home Page-->
    <div class="menu-item">
        <a class="menu-link {{ request()->routeIs('admin.settings.home') ? 'active' : '' }}" href="{{ route('admin.settings.home') }}">
            <span class="menu-icon">{!! getIcon('home-2', 'fs-2') !!}</span>
            <span class="menu-title">Home Page</span>
        </a>
    </div>
    <!--end:Menu item-->

    <!--begin:Menu item - Contact Us-->
    <div class="menu-item">
        <a class="menu-link {{ request()->routeIs('admin.settings.contact') ? 'active' : '' }}" href="{{ route('admin.settings.contact') }}">
            <span class="menu-icon">{!! getIcon('message-text-2', 'fs-2') !!}</span>
            <span class="menu-title">Contact Us</span>
        </a>
    </div>
    <!--end:Menu item-->

    <!--begin:Menu item - Messages-->
    <div class="menu-item">
        <a class="menu-link {{ request()->routeIs('admin.contact-messages.*') ? 'active' : '' }}" href="{{ route('admin.contact-messages.index') }}">
            <span class="menu-icon"><i class="fas fa-envelope fs-2"></i></span>
            <span class="menu-title">Messages
                @if($unreadMessagesCount > 0)
                <span class="badge badge-danger ms-2">{{ $unreadMessagesCount }}</span>
                @endif
            </span>
        </a>
    </div>
    <!--end:Menu item-->

</div>
