@extends('frontend.layouts.frontend')

@section('title', 'Blog - Dental Tips & Advice')
@section('meta_description', 'Read our latest dental tips, advice, and health articles.')

@section('content')

<!-- Page Header -->
<section class="dental-blue text-white py-16">
    <div class="container mx-auto px-4">
        <div class="text-center" data-aos="fade-up">
            <h1 class="text-5xl font-bold mb-4">Dental Blog</h1>
            <p class="text-xl text-blue-100">Tips, advice, and insights for better oral health</p>
        </div>
    </div>
</section>

<!-- Blog Posts -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($posts as $post)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                @if($post->featured_image)
                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-56 object-cover">
                @else
                <div class="w-full h-56 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                    <i class="fas fa-newspaper text-white text-6xl"></i>
                </div>
                @endif
                
                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <i class="fas fa-calendar mr-2"></i>
                        <span>{{ $post->published_at->format('M d, Y') }}</span>
                        <span class="mx-2">•</span>
                        <i class="fas fa-eye mr-2"></i>
                        <span>{{ $post->views }} views</span>
                    </div>
                    
                    <h3 class="text-xl font-bold mb-3 hover:text-blue-600 transition">
                        <a href="{{ route('frontend.blog.show', $post->slug) }}">{{ $post->title }}</a>
                    </h3>
                    
                    <p class="text-gray-600 mb-4">{{ $post->excerpt }}</p>
                    
                    <a href="{{ route('frontend.blog.show', $post->slug) }}" class="text-blue-600 font-semibold hover:text-blue-700">
                        Read More <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-12">
            {{ $posts->links() }}
        </div>
    </div>
</section>

@endsection
