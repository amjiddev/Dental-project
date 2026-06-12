@extends('frontend.layouts.frontend')

@section('meta_title', 'Gallery - Manji Dental')
@section('meta_description', 'View our gallery of dental treatments, clinic facilities, and happy patients.')

@section('frontend-content')

<!-- Page Header -->
<section class="bg-gradient-blue text-white py-5">
    <div class="container py-4">
        <div class="text-center" data-aos="fade-up">
            <h1 class="display-4 fw-bold mb-3 text-white">Our Gallery</h1>
            <p class="lead mb-0">Explore our clinic, treatments, and happy smiles</p>
        </div>
    </div>
</section>

<!-- Gallery Grid -->
<section class="py-5 bg-light">
    <div class="container">
        @if($images->count() > 0)
        <div class="row g-4">
            @foreach($images as $index => $image)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                <div class="gallery-item">
                    <img src="{{ asset($image->image) }}" 
                         alt="{{ $image->title }}" 
                         class="img-fluid w-100 rounded-3 shadow-sm"
                         loading="lazy"
                         style="height: 300px; object-fit: cover; cursor: pointer;"
                         onclick="openLightbox({{ $index }})">
                    @if($image->title)
                    <div class="mt-2">
                        <h6 class="fw-bold mb-1">{{ $image->title }}</h6>
                        @if($image->description)
                        <p class="text-muted small mb-0" style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;">
                            {{ \Illuminate\Support\Str::words($image->description, 4, '...') }}
                        </p>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-5 d-flex justify-content-center">
            {{ $images->links() }}
        </div>
        @else
        <!-- No Gallery Images Message -->
        <div class="text-center py-5">
            <svg width="120" height="120" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="mb-4" style="opacity: 0.6;">
                <rect width="120" height="120" rx="12" fill="#E9ECEF"/>
                <path d="M60 40C50.06 40 42 48.06 42 58V90C42 99.94 50.06 108 60 108C69.94 108 78 99.94 78 90V58C78 48.06 69.94 40 60 40Z" stroke="#6C757D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <circle cx="60" cy="60" r="4" fill="#6C757D"/>
                <path d="M48 80L60 68L72 80" stroke="#6C757D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <h4 class="text-gray-700 fw-bold mb-2">No Images Added Yet</h4>
            <p class="text-muted mb-0">Gallery items will appear here once they are added and activated in the admin panel.</p>
        </div>
        @endif
    </div>
</section>

<!-- Lightbox Modal -->
<div class="modal fade" id="lightboxModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-color: #f5f5f5; border: none;">
            <div class="modal-body p-4 position-relative">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close" style="z-index: 1050;"></button>
                <img id="lightboxImage" src="" alt="" class="img-fluid w-100 rounded-3 mb-3" style="max-height: 400px; object-fit: cover;">
                <div class="text-dark">
                    <h5 id="lightboxTitle" class="mb-2 fw-bold"></h5>
                    <p id="lightboxDescription" class="mb-0 small" style="overflow: hidden; display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical; color: #555555; line-height: 1.6;"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<section class="py-5 bg-gradient-blue text-white">
    <div class="container py-4">
        <div class="row align-items-center" data-aos="fade-up">
            <div class="col-lg-8 text-center text-lg-start mb-4 mb-lg-0">
                <h2 class="h2 fw-bold mb-3 text-white">Ready to Transform Your Smile?</h2>
                <p class="lead mb-0">Book your appointment today and join our happy patients</p>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <a href="{{ route('appointment.create') }}" class="btn btn-light btn-lg px-5 py-3 rounded-pill">
                    <i class="fas fa-calendar-check me-2"></i>Book Now
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('frontend-styles')
<style>
.gallery-item {
    transition: transform 0.3s ease;
}

.gallery-item:hover {
    transform: translateY(-5px);
}

.gallery-item img {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.gallery-item:hover img {
    transform: scale(1.05);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2) !important;
}
</style>
@endpush

@push('frontend-scripts')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 600,
        easing: 'ease-in-out',
        once: true,
        offset: 50
    });

    // Lightbox functionality
    @if($images->count() > 0)
    const images = @json($images->map(function($img) {
        return [
            'src' => asset($img->image),
            'title' => $img->title,
            'description' => $img->description
        ];
    }));
    @else
    const images = [
        {'src': 'https://images.unsplash.com/photo-1606811841689-23dfddce3e95?w=800&h=600&fit=crop', 'title': 'Dental Treatment 1', 'description': 'Professional dental care services'},
        {'src': 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=800&h=600&fit=crop', 'title': 'Dental Treatment 2', 'description': 'Professional dental care services'},
        {'src': 'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?w=800&h=600&fit=crop', 'title': 'Dental Treatment 3', 'description': 'Professional dental care services'},
        {'src': 'https://images.unsplash.com/photo-1598256989800-fe5f95da9787?w=800&h=600&fit=crop', 'title': 'Dental Treatment 4', 'description': 'Professional dental care services'},
        {'src': 'https://images.unsplash.com/photo-1609840114035-3c981960afdd?w=800&h=600&fit=crop', 'title': 'Dental Treatment 5', 'description': 'Professional dental care services'},
        {'src': 'https://images.unsplash.com/photo-1606811841689-23dfddce3e95?w=800&h=600&fit=crop', 'title': 'Dental Treatment 6', 'description': 'Professional dental care services'},
        {'src': 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=800&h=600&fit=crop', 'title': 'Dental Treatment 7', 'description': 'Professional dental care services'},
        {'src': 'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?w=800&h=600&fit=crop', 'title': 'Dental Treatment 8', 'description': 'Professional dental care services'},
        {'src': 'https://images.unsplash.com/photo-1598256989800-fe5f95da9787?w=800&h=600&fit=crop', 'title': 'Dental Treatment 9', 'description': 'Professional dental care services'}
    ];
    @endif

    function openLightbox(index) {
        const image = images[index];
        document.getElementById('lightboxImage').src = image.src;
        document.getElementById('lightboxTitle').textContent = image.title || '';
        document.getElementById('lightboxDescription').textContent = image.description || '';
        
        const modal = new bootstrap.Modal(document.getElementById('lightboxModal'));
        modal.show();
    }
</script>
@endpush
