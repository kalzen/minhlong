@php
    $postsCol = collect($posts ?? []);
    $featuredPosts = $postsCol->take(2);
    $compactPosts = $postsCol->slice(2)->values();
    $defaultListingImages = [
        asset('frontend/images/post-1.jpg'),
        asset('frontend/images/post-2.jpg'),
        asset('frontend/images/post-3.jpg'),
    ];
    $blogIndexUrl = route('site.blog.index');
    $postImageSrc = static function ($post, int $index) use ($defaultListingImages): string {
        return $post->publicFeaturedImageUrl()
            ?? $defaultListingImages[$index % count($defaultListingImages)];
    };
    $postDateUpper = static function ($post): string {
        $d = $post->published_at ?? $post->created_at;

        return strtoupper($d->format('M d, Y'));
    };
@endphp
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

        @if($postsCol->isEmpty())
            {{-- Demo layout when no posts: 2 featured + compact grid (links to blog index) --}}
            <div class="row home-blog-featured-row">
                <div class="col-lg-6">
                    <div class="post-item wow fadeInUp">
                        <div class="post-featured-image">
                            <a href="{{ $blogIndexUrl }}" data-cursor-text="{{ __('site.home.blog.view') }}">
                                <figure>
                                    <img src="{{ asset('frontend') }}/images/post-1.jpg" alt="" loading="lazy">
                                </figure>
                            </a>
                        </div>
                        <div class="post-item-tags"><a href="{{ $blogIndexUrl }}">Industrial EPC</a></div>
                        <div class="post-item-body">
                            <div class="post-content-box">
                                <div class="post-item-meta">
                                    <ul>
                                        <li>{{ __('site.home.blog.posted_on') }} OCT 25, 2025</li>
                                    </ul>
                                </div>
                                <div class="post-item-content">
                                    <h2><a href="{{ $blogIndexUrl }}">How to plan an industrial-zone factory project for faster delivery</a></h2>
                                </div>
                            </div>
                            <div class="post-item-btn">
                                <a href="{{ $blogIndexUrl }}" class="readmore-btn">{{ __('site.home.blog.read_more') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="post-item wow fadeInUp" data-wow-delay="0.15s">
                        <div class="post-featured-image">
                            <a href="{{ $blogIndexUrl }}" data-cursor-text="{{ __('site.home.blog.view') }}">
                                <figure>
                                    <img src="{{ asset('frontend') }}/images/post-2.jpg" alt="" loading="lazy">
                                </figure>
                            </a>
                        </div>
                        <div class="post-item-tags"><a href="{{ $blogIndexUrl }}">M&amp;E Systems</a></div>
                        <div class="post-item-body">
                            <div class="post-content-box">
                                <div class="post-item-meta">
                                    <ul>
                                        <li>{{ __('site.home.blog.posted_on') }} SEP 25, 2025</li>
                                    </ul>
                                </div>
                                <div class="post-item-content">
                                    <h2><a href="{{ $blogIndexUrl }}">M&amp;E coordination strategies that reduce rework on factory sites</a></h2>
                                </div>
                            </div>
                            <div class="post-item-btn">
                                <a href="{{ $blogIndexUrl }}" class="readmore-btn">{{ __('site.home.blog.read_more') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row home-blog-compact-grid">
                @foreach ([
                    ['img' => 'post-3.jpg', 'title' => 'QA/QC checklist for steel structure and fire protection packages', 'date' => 'NOV 02, 2025'],
                    ['img' => 'post-1.jpg', 'title' => 'Industrial power planning for new manufacturing clusters', 'date' => 'OCT 18, 2025'],
                    ['img' => 'post-2.jpg', 'title' => 'Land readiness milestones before mobilizing heavy equipment', 'date' => 'OCT 05, 2025'],
                    ['img' => 'post-3.jpg', 'title' => 'Partner alignment for long-cycle EPC delivery', 'date' => 'SEP 28, 2025'],
                ] as $i => $demo)
                    <div class="col-lg-6">
                        <a href="{{ $blogIndexUrl }}" class="home-blog-compact-item wow fadeInUp" @if($i > 0) data-wow-delay="{{ min($i * 0.08, 0.4) }}s" @endif>
                            <div class="home-blog-compact-thumb">
                                <img src="{{ asset('frontend') }}/images/{{ $demo['img'] }}" alt="" loading="lazy">
                            </div>
                            <div class="home-blog-compact-body">
                                <h3 class="home-blog-compact-title">{{ $demo['title'] }}</h3>
                                <p class="home-blog-compact-date">{{ $demo['date'] }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="row home-blog-footer-row">
                <div class="col-12 text-center">
                    <a href="{{ $blogIndexUrl }}" class="home-blog-view-all">{{ __('site.home.blog.view_all') }}</a>
                </div>
            </div>
        @else
            @if($featuredPosts->isNotEmpty())
                <div class="row home-blog-featured-row">
                    @foreach($featuredPosts as $index => $post)
                        @php
                            $imageSrc = $postImageSrc($post, $index);
                        @endphp
                        <div class="col-lg-6">
                            <div class="post-item wow fadeInUp" @if($index > 0) data-wow-delay="0.15s" @endif>
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
                                                @if(filled($post->creator?->name))
                                                    <li class="home-blog-featured-author">{{ $post->creator->name }}</li>
                                                @endif
                                                <li>{{ __('site.home.blog.posted_on') }} {{ $postDateUpper($post) }}</li>
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
                    @endforeach
                </div>
            @endif

            @if($compactPosts->isNotEmpty())
                <div class="row home-blog-compact-grid">
                    @foreach($compactPosts as $index => $post)
                        @php
                            $listIndex = $index + 2;
                            $imageSrc = $postImageSrc($post, $listIndex);
                        @endphp
                        <div class="col-lg-6">
                            <a href="{{ route('site.blog.show', $post->slug) }}" class="home-blog-compact-item wow fadeInUp" data-cursor-text="{{ __('site.home.blog.view') }}" @if($index > 0) data-wow-delay="{{ min($index * 0.08, 0.4) }}s" @endif>
                                <div class="home-blog-compact-thumb">
                                    <img src="{{ $imageSrc }}" alt="{{ $post->title }}" loading="lazy">
                                </div>
                                <div class="home-blog-compact-body">
                                    <h3 class="home-blog-compact-title">{{ $post->title }}</h3>
                                    <p class="home-blog-compact-date">{{ $postDateUpper($post) }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="row home-blog-footer-row">
                <div class="col-12 text-center">
                    <a href="{{ $blogIndexUrl }}" class="home-blog-view-all">{{ __('site.home.blog.view_all') }}</a>
                </div>
            </div>
        @endif
    </div>
</div>
