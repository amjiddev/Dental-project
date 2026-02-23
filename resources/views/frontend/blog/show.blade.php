@extends('frontend.layouts.frontend')

@section('title', $post->title . ' - Blog')
@section('meta_description', $post->excerpt)

@section('content')

<!-- Page Header -->
<section class="dental-blue text-white py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center" data-aos="fade-up">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $post->title }}</h1>
            <div class="flex items-center justify-center text-blue-100">
                <i class="fas fa-calendar mr-2"></i>
                <span>{{ $post->published_at->format('M d, Y') }}</span>
                <span class="mx-3">•</span>
                <i class="fas fa-user mr-2"></i>
                <span>{{ $post->author->name }}</span>
                <span class="mx-3">•</span>
                <i class="fas fa-eye mr-2"></i>
                <span>{{ $post->views }} views</span>
            </div>
        </div>
    </div>
</section>

<!-- Blog Content -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden" data-aos="fade-up">
                @if($post->featured_image)
                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-96 object-cover">
                @endif
                
                <div class="p-8 md:p-12">
                    <div class="prose max-w-none text-gray-700 leading-relaxed text-lg">
                        {!! nl2br(e($post->content)) !!}
                    </div>
                </div>
            </div>
            
            <!-- Related Posts -->
            @if($relatedPosts->count() > 0)
            <div class="mt-16" data-aos="fade-up">
                <h2 class="text-3xl font-bold mb-8">Related Articles</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedPosts as $related)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition">
                        @if($related->featured_image)
                        <img src="{{ asset('storage/' . $related->featured_image) }}" alt="{{ $related->title }}" class="w-full h-40 object-cover">
                        @else
                        <div class="w-full h-40 bg-gradient-to-br from-blue-400 to-blue-600"></div>
                        @endif
                        <div class="p-4">
                            <h3 class="font-bold mb-2 hover:text-blue-600">
                                <a href="{{ route('frontend.blog.show', $related->slug) }}">{{ $related->title }}</a>
                            </h3>
                            <p class="text-sm text-gray-500">{{ $related->published_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

@endsection
