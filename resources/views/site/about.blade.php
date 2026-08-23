@extends('layouts.minhlong')

@section('content')

{{-- Page Header --}}
<div class="page-header parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.pages.about.title') }}</h1>
                    <nav class="wow fadeInUp" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('site.nav.home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('site.breadcrumb.about') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Company Overview --}}
<div class="about-us">
    <div class="container">
        <div class="row">
            <div class="col-xl-5">
                <div class="about-us-image-box wow fadeInUp">
                    <div class="about-us-image-box-1">
                        <div class="about-us-image">
                            <figure class="image-anime">
                                <img src="{{ \App\Support\SiteMedia::urlOrDefault('about.overview.image_1') }}" alt="{{ __('site.about.image_1_alt') }}">
                            </figure>
                        </div>
                    </div>
                    <div class="about-us-image-box-2">
                        <div class="about-us-image">
                            <figure class="image-anime">
                                <img src="{{ \App\Support\SiteMedia::urlOrDefault('about.overview.image_2') }}" alt="{{ __('site.about.image_2_alt') }}" loading="lazy" decoding="async">
                            </figure>
                        </div>
                        <div class="year-experience-circle">
                            <img src="{{ asset('frontend') }}/images/year-experience-circle-accent.svg" alt="" loading="lazy" decoding="async">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-7">
                <div class="about-us-content">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">{{ __('site.about.who_we_are') }}</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.about.headline') }}</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">{{ __('site.about.description') }}</p>
                    </div>

                    <div class="about-us-body wow fadeInUp" data-wow-delay="0.4s">
                        <div class="about-body-item">
                            <div class="icon-box">
                                <img src="{{ asset('frontend') }}/images/icon-about-item-1.svg" alt="" loading="lazy" decoding="async">
                            </div>
                            <div class="about-body-item-content">
                                <h3>{{ __('site.about.item1_title') }}</h3>
                                <p>{{ __('site.about.item1_desc') }}</p>
                            </div>
                        </div>
                        <div class="about-body-item">
                            <div class="icon-box">
                                <img src="{{ asset('frontend') }}/images/icon-about-item-2.svg" alt="" loading="lazy" decoding="async">
                            </div>
                            <div class="about-body-item-content">
                                <h3>{{ __('site.about.item2_title') }}</h3>
                                <p>{{ __('site.about.item2_desc') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="about-us-footer wow fadeInUp" data-wow-delay="0.6s">
                        <div class="about-us-footer-content">
                            <div class="about-footer-content-list">
                                <ul>
                                    @foreach (__('site.about.footer_list') as $line)
                                        <li>{{ $line }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="about-us-btn">
                                <a href="{{ route('site.contact') }}" class="btn-default">{{ __('site.about.footer_cta') }}</a>
                            </div>
                        </div>
                        <div class="about-us-video-box">
                            <div class="about-video-image">
                                <figure class="image-anime">
                                    <img src="{{ \App\Support\SiteMedia::urlOrDefault('about.overview.video_poster') }}" alt="{{ __('site.about.video_poster_alt') }}" loading="lazy" decoding="async">
                                </figure>
                            </div>
                            <div class="video-play-button">
                                <a href="https://www.youtube.com/watch?v=hDwNapdDdQA" class="popup-video" data-cursor-text="Play">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-play" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Brochure: tagline, vision, competitive edge, chairman letter --}}
<div class="about-brochure-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="about-brochure-tagline wow fadeInUp">
                    <p>{{ __('site.about.group_tagline') }}</p>
                </div>

                <div class="row g-4 mb-5">
                    <div class="col-md-6">
                        <div class="about-brochure-card wow fadeInUp">
                            <h3>{{ __('site.about.vision_title') }}</h3>
                            <p>{{ __('site.about.vision') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="about-brochure-card wow fadeInUp" data-wow-delay="0.1s">
                            <h3>{{ __('site.about.advantage_title') }}</h3>
                            <p>{{ __('site.about.competitive_edge') }}</p>
                        </div>
                    </div>
                </div>

                <div class="about-chairman-letter wow fadeInUp" data-wow-delay="0.2s">
                    <div class="section-title">
                        <h3>{{ __('site.about.chairman.eyebrow') }}</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.about.chairman.title') }}</h2>
                    </div>
                    <div class="about-chairman-body">
                        {!! nl2br(e(__('site.about.chairman.body'))) !!}
                    </div>
                    <div class="about-chairman-signature">
                        <p class="about-chairman-name">{{ __('site.about.chairman.signature') }}</p>
                        <p class="about-chairman-role">{{ __('site.about.chairman.role') }}</p>
                        <p class="about-chairman-date">{{ __('site.about.chairman.date') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- EPC Capabilities --}}
<div class="our-approach dark-section parallaxie">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <div class="section-title section-title-center">
                    <h3 class="wow fadeInUp">{{ __('site.about.approach.eyebrow') }}</h3>
                    <h2 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.about.approach.title') }}</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="approach-item box-1 wow fadeInUp">
                    <div class="icon-box">
                        <img src="{{ asset('frontend') }}/images/approach-item-bg-1.svg" alt="" loading="lazy" decoding="async">
                    </div>
                    <div class="approach-item-image">
                        <figure>
                            <img src="{{ \App\Support\SiteMedia::urlOrDefault('about.approach.image_1') }}" alt="" loading="lazy" decoding="async">
                        </figure>
                    </div>
                    <div class="approach-item-content">
                        <h3>{{ __('site.about.approach.card1_title') }}</h3>
                        <p>{{ __('site.about.approach.card1_desc') }}</p>
                        <ul>
                            <li>{{ __('site.about.approach.card1_li1') }}</li>
                            <li>{{ __('site.about.approach.card1_li2') }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="approach-item box-2 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="icon-box">
                        <img src="{{ asset('frontend') }}/images/approach-item-bg-2.svg" alt="" loading="lazy" decoding="async">
                    </div>
                    <div class="approach-item-image">
                        <figure>
                            <img src="{{ \App\Support\SiteMedia::urlOrDefault('about.approach.image_2') }}" alt="" loading="lazy" decoding="async">
                        </figure>
                    </div>
                    <div class="approach-item-content">
                        <h3>{{ __('site.about.approach.card2_title') }}</h3>
                        <p>{{ __('site.about.approach.card2_desc') }}</p>
                        <ul>
                            <li>{{ __('site.about.approach.card2_li1') }}</li>
                            <li>{{ __('site.about.approach.card2_li2') }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="approach-item box-3 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="icon-box">
                        <img src="{{ asset('frontend') }}/images/approach-item-bg-3.svg" alt="" loading="lazy" decoding="async">
                    </div>
                    <div class="approach-item-image">
                        <figure>
                            <img src="{{ \App\Support\SiteMedia::urlOrDefault('about.approach.image_3') }}" alt="" loading="lazy" decoding="async">
                        </figure>
                    </div>
                    <div class="approach-item-content">
                        <h3>{{ __('site.about.approach.card3_title') }}</h3>
                        <p>{{ __('site.about.approach.card3_desc') }}</p>
                        <ul>
                            <li>{{ __('site.about.approach.card3_li1') }}</li>
                            <li>{{ __('site.about.approach.card3_li2') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Key Metrics --}}
<div class="our-features">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <div class="section-title section-title-center">
                    <h3 class="wow fadeInUp">{{ __('site.about.metrics.eyebrow') }}</h3>
                    <h2 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.about.metrics.title') }}</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="feature-item box-1 wow fadeInUp">
                    <div class="feature-item-content-box">
                        <div class="feature-item-content">
                            <h2><span class="counter">{{ __('site.about.metrics.stat1_value') }}</span>{{ __('site.about.metrics.stat1_suffix') }}</h2>
                            <h3>{{ __('site.about.metrics.stat1_label') }}</h3>
                        </div>
                        <div class="feature-item-counter-info">
                            <p>{{ __('site.about.metrics.stat1_desc') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="feature-item box-2 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="feature-item-content-box">
                        <div class="feature-item-content">
                            <h2><span class="counter">{{ __('site.about.metrics.stat2_value') }}</span>{{ __('site.about.metrics.stat2_suffix') }}</h2>
                            <h3>{{ __('site.about.metrics.stat2_label') }}</h3>
                        </div>
                        <div class="feature-item-counter-info">
                            <p>{{ __('site.about.metrics.stat2_desc') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="feature-item box-3 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="feature-item-content-box">
                        <div class="feature-item-content">
                            <h2><span class="counter">{{ __('site.about.metrics.stat3_value') }}</span>{{ __('site.about.metrics.stat3_suffix') }}</h2>
                            <h3>{{ __('site.about.metrics.stat3_label') }}</h3>
                        </div>
                        <div class="feature-item-counter-info">
                            <p>{{ __('site.about.metrics.stat3_desc') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
