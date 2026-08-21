<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {!! printHtmlAttributes('html') !!}>
<!--begin::Head-->

<head>
    <base href="" />
    <title>@yield('meta_title', 'BrightSmile Dental Clinic')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8" />
    <meta name="description" content="@yield('meta_description', '')" />
    <meta name="keywords" content="@yield('meta_keywords', '')" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="@yield('meta_title', 'BrightSmile Dental Clinic')" />
    <meta property="og:description" content="@yield('meta_description', '')" />
    <link rel="canonical" href="{{ url()->current() }}" />
    <meta name="api-base" content="{{ env('STORE_URL') }}">

    <meta name="author" content="" />

    <!-- Favicons -->
    <link rel="icon" type="image/png" href="{{ asset('frontend/images/dental-logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('frontend/images/dental-logo.png') }}">


    <link rel="stylesheet" href="{{ asset('frontend/css') }}/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" />
    
    <!-- Font Awesome - Local -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Google Fonts - Preload for faster loading -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@600;700;800&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet"></noscript>
    
    <!-- Slick Carousel - Lazy Load -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"></noscript>

    <link rel="stylesheet" href="{{ asset('frontend/css') }}/custom.css" />
    
    <!-- Custom Dental Clinic Styles -->
    <style>
        :root {
            /* Brand Colors - Blue Theme */
            --primary-blue: #1e40af;
            --primary-blue-dark: #1e3a8a;
            --primary-blue-light: #3b82f6;
            --secondary-blue: #60a5fa;
            --accent-blue: #93c5fd;
            --light-blue: #dbeafe;
            --white: #ffffff;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-600: #4b5563;
            --gray-800: #1f2937;
            --gray-900: #111827;
            
            /* Typography */
            --font-primary: 'Inter', sans-serif;
            --font-heading: 'Playfair Display', serif;
        }

        /* Global Styles */
        body {
            font-family: var(--font-primary);
            color: var(--gray-800);
            line-height: 1.6;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-heading);
            font-weight: 700;
            color: var(--primary-blue-dark);
        }

        /* Primary Button */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-blue-light) 100%);
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(30, 64, 175, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(30, 64, 175, 0.3);
            background: linear-gradient(135deg, var(--primary-blue-dark) 0%, var(--primary-blue) 100%);
        }

        /* Secondary Button */
        .btn-outline-primary {
            border: 2px solid var(--primary-blue);
            color: var(--primary-blue);
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background: var(--primary-blue);
            color: white;
            transform: translateY(-2px);
        }

        /* Section Titles */
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-blue-dark);
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            border-radius: 2px;
        }

        .section-subtitle {
            color: var(--gray-600);
            font-size: 1.1rem;
            margin-bottom: 3rem;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
        }

        /* Links */
        a {
            color: var(--primary-blue);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        a:hover {
            color: var(--primary-blue-dark);
        }

        /* Background Patterns */
        .bg-light-blue {
            background-color: var(--light-blue);
        }

        .bg-gradient-blue {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-blue-light) 100%);
        }

        /* Testimonial Slider Styles */
        .testimonial-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
            margin: 10px;
            transition: all 0.3s ease;
        }

        .testimonial-card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
        }

        .testimonial-rating {
            color: #fbbf24;
            font-size: 1.2rem;
            margin-bottom: 15px;
        }

        .testimonial-text {
            font-size: 1rem;
            color: var(--gray-600);
            line-height: 1.8;
            margin-bottom: 20px;
            font-style: italic;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .testimonial-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .testimonial-name {
            font-weight: 600;
            color: var(--primary-blue-dark);
            margin-bottom: 0;
        }

        /* Slick Slider Customization */
        .slick-dots li button:before {
            color: var(--primary-blue);
            font-size: 12px;
        }

        .slick-dots li.slick-active button:before {
            color: var(--primary-blue);
        }

        .slick-prev:before,
        .slick-next:before {
            color: var(--primary-blue);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .section-title {
                font-size: 2rem;
            }
        }
    </style>
    <!--end::Custom Stylesheets-->

    @stack('frontend-styles')

    @livewireStyles
</head>
<!--end::Head-->

<!--begin::Body-->

<body {!! printHtmlClasses('body') !!} {!! printHtmlAttributes('body') !!}>

    @include('partials/theme-mode/_init')

    @include('frontend.layouts.partials.header')

    @yield('frontend-content')

    @include('frontend.layouts.partials.footer')

    <!-- jQuery - Defer loading -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>

    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    @foreach (getGlobalAssets() as $path)
        {!! sprintf('<script src="%s" defer></script>', asset($path)) !!}
    @endforeach
    <!--end::Global Javascript Bundle-->

    <!--begin::Vendors Javascript(used by this page)-->
    @foreach (getVendors('js') as $path)
        {!! sprintf('<script src="%s" defer></script>', asset($path)) !!}
    @endforeach
    <!--end::Vendors Javascript-->

    <!--begin::Custom Javascript(optional)-->
    @foreach (getCustomJs() as $path)
        {!! sprintf('<script src="%s" defer></script>', asset($path)) !!}
    @endforeach
    <!--end::Custom Javascript-->
    
    <!-- JS - Defer loading -->
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" defer></script>
    <script src="{{ asset('frontend/js') }}/bootstrap.bundle.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" defer></script>
    <script src="{{ asset('frontend/js') }}/custom.js" defer></script>
    <script src="{{ asset('assets/js/custom/widgets.js') }}" defer></script>

    @stack('frontend-scripts')
    <!--end::Javascript-->

    @if (session('success'))
        <script>
            toastr.success("{{ session('success') }}");
        </script>
    @endif

    @if (session('error'))
        <script>
            toastr.error("{{ session('error') }}");
        </script>
    @endif

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('success', (message) => {
                toastr.success(message);
            });
            Livewire.on('error', (message) => {
                toastr.error(message);
            });

            Livewire.on('swal', (message, icon, confirmButtonText) => {
                if (typeof icon === 'undefined') {
                    icon = 'success';
                }
                if (typeof confirmButtonText === 'undefined') {
                    confirmButtonText = 'Ok, got it!';
                }
                Swal.fire({
                    text: message,
                    icon: icon,
                    buttonsStyling: false,
                    confirmButtonText: confirmButtonText,
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    }
                });
            });
        });
    </script>

    @livewireScripts

</body>
<!--end::Body-->

</html>
