<div class="our-blog">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <div class="section-title section-title-center">
                    <h3 class="wow fadeInUp">{{ __('site.home.blog.title') }}</h3>
                    <h2 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.home.blog.subtitle') }}</h2>
                </div>
            </div>
        </div>
        <div class="row">
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
                        <a href="{{ route('site.blog.show', $post->slug) }}" data-cursor-text="{{ __('site.home.blog.view') }}">
                            <figure>
                                <img src="{{ $imageSrc }}" alt="{{ $post->title }}" loading="lazy">
                            </figure>
                        </a>
                    </div>
                    <div class="post-item-tags">
                        <a href="{{ route('site.blog.show', $post->slug) }}">{{ $post->category?->name ?? 'Blog' }}</a>
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
                            <a href="{{ route('site.blog.show', $post->slug) }}" class="readmore-btn">{{ __('site.home.blog.read_more') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            {{-- Demo content when no posts --}}
            <div class="col-xl-4 col-md-6">
                <div class="post-item wow fadeInUp">
                    <div class="post-featured-image">
                            <a href="#" data-cursor-text="{{ __('site.home.blog.view') }}">
                            <figure>
                                <img src="{{ asset('frontend') }}/images/post-1.jpg" alt="">
                            </figure>
                        </a>
                    </div>
                    <div class="post-item-tags"><a href="#">Industrial EPC</a></div>
                    <div class="post-item-body">
                        <div class="post-content-box">
                            <div class="post-item-meta"><ul><li>OCT 25, 2025</li></ul></div>
                            <div class="post-item-content">
                                <h2><a href="#">How to plan an industrial-zone factory project for faster delivery</a></h2>
                            </div>
                        </div>
                        <div class="post-item-btn"><a href="#" class="readmore-btn">{{ __('site.home.blog.read_more') }}</a></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="post-item wow fadeInUp" data-wow-delay="0.2s">
                    <div class="post-featured-image">
                            <a href="#" data-cursor-text="{{ __('site.home.blog.view') }}">
                            <figure>
                                <img src="{{ asset('frontend') }}/images/post-2.jpg" alt="">
                            </figure>
                        </a>
                    </div>
                    <div class="post-item-tags"><a href="#">M&amp;E Systems</a></div>
                    <div class="post-item-body">
                        <div class="post-content-box">
                            <div class="post-item-meta"><ul><li>SEP 25, 2025</li></ul></div>
                            <div class="post-item-content">
                                <h2><a href="#">M&amp;E coordination strategies that reduce rework on factory sites</a></h2>
                            </div>
                        </div>
                        <div class="post-item-btn"><a href="#" class="readmore-btn">{{ __('site.home.blog.read_more') }}</a></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="post-item wow fadeInUp" data-wow-delay="0.4s">
                    <div class="post-featured-image">
                            <a href="#" data-cursor-text="{{ __('site.home.blog.view') }}">
                            <figure>
                                <img src="{{ asset('frontend') }}/images/post-3.jpg" alt="">
                            </figure>
                        </a>
                    </div>
                    <div class="post-item-tags"><a href="#">Safety & Quality</a></div>
                    <div class="post-item-body">
                        <div class="post-content-box">
                            <div class="post-item-meta"><ul><li>NOV 02, 2025</li></ul></div>
                            <div class="post-item-content">
                                <h2><a href="#">QA/QC checklist for steel structure and fire protection packages</a></h2>
                            </div>
                        </div>
                        <div class="post-item-btn"><a href="#" class="readmore-btn">{{ __('site.home.blog.read_more') }}</a></div>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
