<!-- Main Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <div class="d-flex align-items-center">
                <img src="{{ asset('frontend/images/dental-logo.png') }}" alt="" class="me-2" style="height: 2rem; width: auto;">
                <div>
                    <div class="fw-bold text-primary" style="font-size: 1.3rem; line-height: 1;">BrightSmile Dental</div>
                    <div class="text-muted" style="font-size: 0.75rem;">& Aesthetic Centre</div>
                </div>
            </div>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <!-- 1. Home -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                
                <!-- 2. About Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('about*') || request()->routeIs('team') ? 'active' : '' }}" 
                       href="{{ route('about') }}" 
                       id="aboutDropdown" 
                       role="button">
                        About <i class="fas fa-chevron-down ms-1" style="font-size: 0.7rem;"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                        <li><a class="dropdown-item" href="{{ route('about') }}">About Us</a></li>
                        <li><a class="dropdown-item" href="{{ route('team') }}">Our Team</a></li>
                    </ul>
                </li>
                
                <!-- 3. Services Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('services.*') ? 'active' : '' }}" 
                       href="{{ route('services.index') }}" 
                       id="servicesDropdown" 
                       role="button">
                        Services <i class="fas fa-chevron-down ms-1" style="font-size: 0.7rem;"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                        @forelse($frontendServices ?? [] as $service)
                        <li><a class="dropdown-item" href="{{ route('services.show', $service->slug) }}">{{ $service->name }}</a></li>
                        @empty
                        <li><a class="dropdown-item" href="{{ route('services.index') }}">View All Services</a></li>
                        @endforelse
                    </ul>
                </li>
                
                <!-- 4. Discounts -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('discounts') ? 'active' : '' }}" href="{{ route('discounts') }}">Discounts</a>
                </li>
                
                <!-- 5. Gallery -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}">Gallery</a>
                </li>
                
                <!-- 6. Contact Us -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact Us</a>
                </li>
                
                <li class="nav-item ms-lg-3">
                    <a class="btn btn-primary px-4" href="{{ route('appointment.create') }}">
                        <i class="fas fa-calendar-check me-2"></i>Book Appointment
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Spacer for fixed navbar -->
<div class="navbar-spacer"></div>

<script>
// Smart sticky navbar - hide on scroll down, show on scroll up
document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.querySelector('.navbar');
    let lastScrollTop = 0;
    const scrollThreshold = 100; // Only hide after scrolling past 100px
    
    window.addEventListener('scroll', function() {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        // Always show navbar at the top
        if (scrollTop < scrollThreshold) {
            navbar.classList.remove('navbar-hidden');
            lastScrollTop = scrollTop;
            return;
        }
        
        // Scrolling down - hide navbar
        if (scrollTop > lastScrollTop) {
            navbar.classList.add('navbar-hidden');
        } 
        // Scrolling up - show navbar
        else {
            navbar.classList.remove('navbar-hidden');
        }
        
        lastScrollTop = scrollTop;
    }, { passive: true });
    
    // Hover functionality for dropdowns on desktop
    if (window.innerWidth >= 992) {
        const dropdowns = document.querySelectorAll('.navbar .dropdown');
        
        dropdowns.forEach(function(dropdown) {
            let timeout;
            
            dropdown.addEventListener('mouseenter', function() {
                clearTimeout(timeout);
                this.classList.add('show');
                const menu = this.querySelector('.dropdown-menu');
                if (menu) {
                    menu.classList.add('show');
                }
            });
            
            dropdown.addEventListener('mouseleave', function() {
                timeout = setTimeout(() => {
                    this.classList.remove('show');
                    const menu = this.querySelector('.dropdown-menu');
                    if (menu) {
                        menu.classList.remove('show');
                    }
                }, 150);
            });
        });
    }
});
</script>

<style>
.navbar {
    padding: 1rem 0;
    transition: transform 0.3s ease;
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    right: 0 !important;
    z-index: 1030 !important;
}

/* Add spacing below navbar so content isn't hidden behind it */
.navbar-spacer {
    height: 76px;
}

.navbar.navbar-hidden {
    transform: translateY(-100%);
}

.navbar-brand {
    transition: transform 0.3s ease;
}

.navbar-brand:hover {
    transform: scale(1.05);
}

.nav-link {
    font-weight: 500;
    color: #4b5563 !important;
    padding: 0.5rem 1rem !important;
    transition: color 0.3s ease;
    position: relative;
}

.nav-link:hover,
.nav-link.active {
    color: var(--primary-blue) !important;
}

.nav-link::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 2px;
    background: var(--primary-blue);
    transition: width 0.3s ease;
}

.nav-link:hover::after,
.nav-link.active::after {
    width: 80%;
}

/* Dropdown Icon Animation */
.nav-link i.fa-chevron-down {
    transition: transform 0.3s ease;
}

.nav-item.dropdown:hover .nav-link i.fa-chevron-down,
.nav-item.dropdown.show .nav-link i.fa-chevron-down {
    transform: rotate(180deg);
}

/* Dropdown Menu */
.dropdown-menu {
    border: none;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    padding: 0.5rem 0;
    margin-top: 0;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    pointer-events: none;
}

.dropdown-menu::before {
    content: '';
    position: absolute;
    top: -10px;
    left: 0;
    right: 0;
    height: 10px;
}

.dropdown-menu.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
    pointer-events: auto;
}

/* Hover to open dropdown on desktop */
@media (min-width: 992px) {
    .nav-item.dropdown {
        padding-bottom: 1rem;
        margin-bottom: -1rem;
    }
    
    .nav-item.dropdown:hover .dropdown-menu,
    .nav-item.dropdown.show .dropdown-menu {
        display: block;
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
}

.dropdown-item {
    padding: 0.6rem 1.5rem;
    transition: all 0.3s ease;
    font-weight: 500;
}

.dropdown-item:hover {
    background: var(--light-blue);
    color: var(--primary-blue);
    padding-left: 2rem;
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-blue-light) 100%);
    border: none;
    font-weight: 600;
    border-radius: 25px;
    padding: 0.6rem 1.5rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(30, 64, 175, 0.2);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(30, 64, 175, 0.3);
}

@media (max-width: 991px) {
    .nav-link::after {
        display: none;
    }
    
    .navbar-nav {
        padding: 1rem 0;
    }
    
    .nav-item {
        padding: 0.25rem 0;
    }
    
    .dropdown-menu {
        border: none;
        box-shadow: none;
        background: #f8f9fa;
        margin-top: 0;
    }
}
</style>
