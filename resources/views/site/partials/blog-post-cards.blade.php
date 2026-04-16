{{-- Expects $posts (iterable of Post). Optional: $emptyFallback, $readMore, $viewCursor --}}
@php
    $showDemoWhenEmpty = $emptyFallback ?? true;
    $readMoreLabel = $readMore ?? __('site.common.read_more');
    $viewCursorLabel = $viewCursor ?? __('site.common.view');
@endphp
@php
    $defaultListingImages = [
        asset('frontend/images/post-1.jpg'),
        asset('frontend/images/post-2.jpg'),
        asset('frontend/images/post-3.jpg'),
    ];
@endphp
@forelse($posts ?? [] as $index => $post)
    @php
        $imageSrc = $post->publicFeaturedImageUrl()
            ?? $defaultListingImages[$index % count($defaultListingImages)];
    @endphp
    <div class="col-xl-4 col-md-6">
        <div class="post-item wow fadeInUp" @if($index > 0) data-wow-delay="{{ $index * 0.2 }}s" @endif>
            <div class="post-featured-image">
                <a href="{{ route('site.blog.show', $post->slug) }}" data-cursor-text="{{ $viewCursorLabel }}">
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
                    <a href="{{ route('site.blog.show', $post->slug) }}" class="readmore-btn">{{ $readMoreLabel }}</a>
                </div>
            </div>
        </div>
    </div>
@empty
    @if($showDemoWhenEmpty)
        <div class="col-xl-4 col-md-6">
            <div class="post-item wow fadeInUp">
                <div class="post-featured-image">
                    <a href="{{ route('site.blog.index') }}" data-cursor-text="{{ $viewCursorLabel }}">
                        <figure>
                            <img src="{{ asset('frontend') }}/images/post-1.jpg" alt="" loading="lazy">
                        </figure>
                    </a>
                </div>
                <div class="post-item-tags"><a href="{{ route('site.blog.index') }}">Blog</a></div>
                <div class="post-item-body">
                    <div class="post-content-box">
                        <div class="post-item-meta"><ul><li>—</li></ul></div>
                        <div class="post-item-content">
                            <h2><a href="{{ route('site.blog.index') }}">{{ __('site.home.blog.empty') }}</a></h2>
                        </div>
                    </div>
                    <div class="post-item-btn">
                        <a href="{{ route('site.blog.index') }}" class="readmore-btn">{{ $readMoreLabel }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="post-item wow fadeInUp" data-wow-delay="0.2s">
                <div class="post-featured-image">
                    <a href="{{ route('site.blog.index') }}" data-cursor-text="{{ $viewCursorLabel }}">
                        <figure>
                            <img src="{{ asset('frontend') }}/images/post-2.jpg" alt="" loading="lazy">
                        </figure>
                    </a>
                </div>
                <div class="post-item-tags"><a href="{{ route('site.blog.index') }}">Blog</a></div>
                <div class="post-item-body">
                    <div class="post-content-box">
                        <div class="post-item-meta"><ul><li>—</li></ul></div>
                        <div class="post-item-content">
                            <h2><a href="{{ route('site.blog.index') }}">{{ __('site.home.blog.empty') }}</a></h2>
                        </div>
                    </div>
                    <div class="post-item-btn">
                        <a href="{{ route('site.blog.index') }}" class="readmore-btn">{{ $readMoreLabel }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="post-item wow fadeInUp" data-wow-delay="0.4s">
                <div class="post-featured-image">
                    <a href="{{ route('site.blog.index') }}" data-cursor-text="{{ $viewCursorLabel }}">
                        <figure>
                            <img src="{{ asset('frontend') }}/images/post-3.jpg" alt="" loading="lazy">
                        </figure>
                    </a>
                </div>
                <div class="post-item-tags"><a href="{{ route('site.blog.index') }}">Blog</a></div>
                <div class="post-item-body">
                    <div class="post-content-box">
                        <div class="post-item-meta"><ul><li>—</li></ul></div>
                        <div class="post-item-content">
                            <h2><a href="{{ route('site.blog.index') }}">{{ __('site.home.blog.empty') }}</a></h2>
                        </div>
                    </div>
                    <div class="post-item-btn">
                        <a href="{{ route('site.blog.index') }}" class="readmore-btn">{{ $readMoreLabel }}</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforelse
