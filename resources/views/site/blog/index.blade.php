@extends('layouts.minhlong')

@section('content')
<div class="page-header parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.pages.blog.latest') }}</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('site.nav.home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('site.breadcrumb.blog') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-blog">
    <div class="container">
        @php
            $defaultListingImages = [
                asset('frontend/images/post-1.webp'),
                asset('frontend/images/post-2.webp'),
                asset('frontend/images/post-3.webp'),
            ];
        @endphp
        <div class="row">
            @forelse($posts as $index => $post)
            @php
                $imageSrc = $post->publicFeaturedImageUrl()
                    ?? $defaultListingImages[$index % count($defaultListingImages)];
            @endphp
            <div class="col-xl-4 col-md-6">
                <div class="post-item wow fadeInUp" @if($index > 0) data-wow-delay="{{ min($index * 0.1, 0.4) }}s" @endif>
                    <div class="post-featured-image">
                        <a href="{{ route('site.blog.show', $post->slug) }}" data-cursor-text="{{ __('site.home.blog.view') }}">
                            <figure>
                                <img src="{{ $imageSrc }}" alt="{{ $post->title }}" loading="lazy">
                            </figure>
                        </a>
                    </div>
                        <div class="post-item-tags">
                        <a href="{{ route('site.blog.show', $post->slug) }}">{{ $post->category?->name ?? __('site.breadcrumb.blog') }}</a>
                    </div>
                    <div class="post-item-body">
                        <div class="post-content-box">
                            <div class="post-item-meta">
                                <ul>
                                    <li>{{ $post->published_at?->format('M d, Y') ?? $post->created_at->format('M d, Y') }}</li>
                                </ul>
                            </div>
                            <div class="post-item-content">
                                <h2><a href="{{ route('site.blog.show', $post->slug) }}">{{ $post->title }}</a></h2>
                            </div>
                        </div>
                        <div class="post-item-btn">
                            <a href="{{ route('site.blog.show', $post->slug) }}" class="readmore-btn">{{ __('site.common.read_more') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p class="text-center">{{ __('site.home.blog.empty') }}</p>
            </div>
            @endforelse
        </div>
        @if($posts->hasPages())
        <div class="row">
            <div class="col-lg-12">
                {{ $posts->onEachSide(1)->links('vendor.pagination.minhlong') }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
