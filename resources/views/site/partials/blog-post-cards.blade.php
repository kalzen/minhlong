{{-- Expects $posts (iterable of Post). Optional: $emptyFallback, $readMore, $viewCursor --}}
@php
    $showDemoWhenEmpty = $emptyFallback ?? true;
    $readMoreLabel = $readMore ?? __('site.common.read_more');
    $viewCursorLabel = $viewCursor ?? __('site.common.view');
@endphp
@php
    $unsplashFallbacks = [
        'https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1518005020951-eccb494ad742?auto=format&fit=crop&w=1200&q=80',
    ];
@endphp
@forelse($posts ?? [] as $index => $post)
    @php
        $thumbnailPath = $post->thumbnail_path;
        $imageSrc = $unsplashFallbacks[$index % count($unsplashFallbacks)];

        if (filled($thumbnailPath)) {
            if (str_starts_with($thumbnailPath, 'http://') || str_starts_with($thumbnailPath, 'https://')) {
                $imageSrc = $thumbnailPath;
            } elseif (is_file(public_path($thumbnailPath))) {
                $imageSrc = asset($thumbnailPath);
            }
        }
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
