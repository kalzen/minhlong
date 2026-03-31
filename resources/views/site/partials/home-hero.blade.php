{{-- Hero content: PROJECT_REQUIREMENTS.md §11 — Minh Long Group, English default --}}
<div class="hero dark-section parallaxie">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-8 col-md-10">
                <div class="hero-content">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">{{ __('site.home.hero.tagline') }}</h3>
                        <h1 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.home.hero.title') }}</h1>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">{{ __('site.home.hero.description') }}</p>
                    </div>
                    <div class="hero-content-body wow fadeInUp" data-wow-delay="0.4s">
                        <div class="hero-btn">
                            <a href="{{ route('site.contact') }}" class="btn-default btn-highlighted">{{ __('site.home.hero.cta') }}</a>
                        </div>
                        <div class="video-play-button">
                            <a href="https://www.youtube.com/watch?v=hDwNapdDdQA" class="popup-video" data-cursor-text="Play">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-play" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                </svg>
                            </a>
                            <h3>{{ __('site.home.hero.video') }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-2">
                <div class="year-experience-circle">
                    <img src="{{ asset('frontend') }}/images/year-experience-circle-transperant.svg" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
