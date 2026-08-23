@php
    $postsCol = collect($posts ?? []);
    $defaultListingImages = [
        asset('frontend/images/post-1.webp'),
        asset('frontend/images/post-2.webp'),
        asset('frontend/images/post-3.webp'),
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
            {{-- Demo: same compact row style for all entries --}}
            <div class="row home-blog-compact-grid">
                @foreach ([
                    ['img' => 'post-1.jpg', 'title' => 'How to plan an industrial-zone factory project for faster delivery', 'date' => 'OCT 25, 2025'],
                    ['img' => 'post-2.jpg', 'title' => 'M&amp;E coordination strategies that reduce rework on factory sites', 'date' => 'SEP 25, 2025'],
                    ['img' => 'post-3.jpg', 'title' => 'QA/QC checklist for steel structure and fire protection packages', 'date' => 'NOV 02, 2025'],
                    ['img' => 'post-1.jpg', 'title' => 'Industrial power planning for new manufacturing clusters', 'date' => 'OCT 18, 2025'],
                    ['img' => 'post-2.jpg', 'title' => 'Land readiness milestones before mobilizing heavy equipment', 'date' => 'OCT 05, 2025'],
                    ['img' => 'post-3.jpg', 'title' => 'Partner alignment for long-cycle EPC delivery', 'date' => 'SEP 28, 2025'],
                ] as $i => $demo)
                    <div class="col-lg-6">
                        <a href="{{ $blogIndexUrl }}" class="home-blog-compact-item wow fadeInUp" data-cursor-text="{{ __('site.home.blog.view') }}" @if($i > 0) data-wow-delay="{{ min($i * 0.06, 0.36) }}s" @endif>
                            <div class="home-blog-compact-thumb">
                                <img src="{{ asset('frontend') }}/images/{{ $demo['img'] }}" alt="" loading="lazy">
                            </div>
                            <div class="home-blog-compact-body">
                                <h3 class="home-blog-compact-title">{!! $demo['title'] !!}</h3>
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
            <div class="row home-blog-compact-grid">
                @foreach($postsCol as $index => $post)
                    @php
                        $imageSrc = $postImageSrc($post, $index);
                    @endphp
                    <div class="col-lg-6">
                        <a href="{{ route('site.blog.show', $post->slug) }}" class="home-blog-compact-item wow fadeInUp" data-cursor-text="{{ __('site.home.blog.view') }}" @if($index > 0) data-wow-delay="{{ min($index * 0.06, 0.36) }}s" @endif>
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

            <div class="row home-blog-footer-row">
                <div class="col-12 text-center">
                    <a href="{{ $blogIndexUrl }}" class="home-blog-view-all">{{ __('site.home.blog.view_all') }}</a>
                </div>
            </div>
        @endif
    </div>
</div>
