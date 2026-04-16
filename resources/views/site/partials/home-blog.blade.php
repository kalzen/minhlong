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
            @php
                $blogIndexUrl = route('site.blog.index');
            @endphp
            {{-- Placeholder cards when no posts for this locale: link to blog listing (not static HTML) --}}
            <div class="col-xl-4 col-md-6">
                <div class="post-item wow fadeInUp">
                    <div class="post-featured-image">
                            <a href="{{ $blogIndexUrl }}" data-cursor-text="{{ __('site.home.blog.view') }}">
                            <figure>
                                <img src="{{ asset('frontend') }}/images/post-1.jpg" alt="">
                            </figure>
                        </a>
                    </div>
                    <div class="post-item-tags"><a href="{{ $blogIndexUrl }}">Industrial EPC</a></div>
                    <div class="post-item-body">
                        <div class="post-content-box">
                            <div class="post-item-meta"><ul><li>OCT 25, 2025</li></ul></div>
                            <div class="post-item-content">
                                <h2><a href="{{ $blogIndexUrl }}">How to plan an industrial-zone factory project for faster delivery</a></h2>
                            </div>
                        </div>
                        <div class="post-item-btn"><a href="{{ $blogIndexUrl }}" class="readmore-btn">{{ __('site.home.blog.read_more') }}</a></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="post-item wow fadeInUp" data-wow-delay="0.2s">
                    <div class="post-featured-image">
                            <a href="{{ $blogIndexUrl }}" data-cursor-text="{{ __('site.home.blog.view') }}">
                            <figure>
                                <img src="{{ asset('frontend') }}/images/post-2.jpg" alt="">
                            </figure>
                        </a>
                    </div>
                    <div class="post-item-tags"><a href="{{ $blogIndexUrl }}">M&amp;E Systems</a></div>
                    <div class="post-item-body">
                        <div class="post-content-box">
                            <div class="post-item-meta"><ul><li>SEP 25, 2025</li></ul></div>
                            <div class="post-item-content">
                                <h2><a href="{{ $blogIndexUrl }}">M&amp;E coordination strategies that reduce rework on factory sites</a></h2>
                            </div>
                        </div>
                        <div class="post-item-btn"><a href="{{ $blogIndexUrl }}" class="readmore-btn">{{ __('site.home.blog.read_more') }}</a></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="post-item wow fadeInUp" data-wow-delay="0.4s">
                    <div class="post-featured-image">
                            <a href="{{ $blogIndexUrl }}" data-cursor-text="{{ __('site.home.blog.view') }}">
                            <figure>
                                <img src="{{ asset('frontend') }}/images/post-3.jpg" alt="">
                            </figure>
                        </a>
                    </div>
                    <div class="post-item-tags"><a href="{{ $blogIndexUrl }}">Safety & Quality</a></div>
                    <div class="post-item-body">
                        <div class="post-content-box">
                            <div class="post-item-meta"><ul><li>NOV 02, 2025</li></ul></div>
                            <div class="post-item-content">
                                <h2><a href="{{ $blogIndexUrl }}">QA/QC checklist for steel structure and fire protection packages</a></h2>
                            </div>
                        </div>
                        <div class="post-item-btn"><a href="{{ $blogIndexUrl }}" class="readmore-btn">{{ __('site.home.blog.read_more') }}</a></div>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
