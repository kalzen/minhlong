@extends('layouts.minhlong')

@push('head')
    @isset($hreflangAlternates)
        @foreach ($hreflangAlternates as $locale => $url)
            <link rel="alternate" hreflang="{{ $locale }}" href="{{ $url }}">
        @endforeach
    @endisset
@endpush

@section('content')
<div class="page-header parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">{{ $post->title }}</h1>
                    <div class="post-single-meta wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('site.nav.home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('site.blog.index') }}">{{ __('site.breadcrumb.blog') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($post->title, 30) }}</li>
                        </ol>
                        <ol class="breadcrumb">
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-clock" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                {{ $post->published_at?->format('d M, Y') ?? $post->created_at->format('d M, Y') }}
                            </li>
                            @if($post->category)
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-folder" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h5l2 3h9v11H4z"></path>
                                </svg>
                                {{ $post->category->name }}
                            </li>
                            @endif
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-single-post">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @if($post->thumbnail_path)
                <div class="post-image">
                    <figure class="image-anime reveal">
                        <img src="{{ asset($post->thumbnail_path) }}" alt="{{ $post->title }}">
                    </figure>
                </div>
                @endif
                <div class="post-content">
                    <div class="post-entry">
                        {!! $post->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
