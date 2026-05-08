@extends('layouts.minhlong')

@section('content')

    {{-- Hero Section (clone from index-3 with Minh Long Host content) --}}
    <div class="hero-gold dark-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Hero Content Start -->
                    <div class="hero-content-gold">
                        <!-- Hero Sub Heading Start -->
                        <div class="hero-sub-heading-gold wow fadeInUp">
                            <!-- Satisfy Client Content Start -->
                            <div class="hero-sub-heading-content-gold">
                                <p>{{ __('site.host.hero.brand') }}</p>
                            </div>
                            <!-- Satisfy Client Content End -->
                        </div>
                        <!-- Hero Sub Heading End -->

                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h1 class="text-anime-style-3" data-cursor="-opaque">
                                {{ __('site.host.hero.title') }}
                            </h1>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">
                                {{ __('site.host.hero.description') }}
                            </p>
                        </div>
                        <!-- Section Title End -->

                        <!-- Hero Content Body Start -->
                        <div class="hero-content-body-gold wow fadeInUp" data-wow-delay="0.4s">
                            <!-- Hero Button Start -->
                            <div class="hero-btn-gold">
                                <a href="{{ route('site.contact') }}" class="btn-default btn-highlighted">
                                    {{ __('site.host.hero.cta') }}
                                </a>
                            </div>
                            <!-- Hero Button End -->

                            <!-- Video Play Button Start -->
                            <div class="video-play-button">
                                <a href="https://www.youtube.com/watch?v=hDwNapdDdQA" class="popup-video" data-cursor-text="{{ __('site.common.play') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-play" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                    </svg>
                                </a>
                                <h3>{{ __('site.host.hero.video') }}</h3>
                            </div>
                            <!-- Video Play Button End -->
                        </div>
                        <!-- Hero Content Body End -->
                    </div>
                    <!-- Hero Content End -->

                    <!-- Hero Image Box Start -->
                    <div class="hero-image-box-gold wow fadeInUp" data-wow-delay="0.2s">
                        <!-- Hero Image Start -->
                        <div class="hero-image-gold">
                            <figure class="image-anime">
                                <img src="{{ \App\Support\SiteMedia::urlOrDefault('sector.host.hero') }}" alt="{{ __('site.host.hero.brand') }}">
                            </figure>
                        </div>
                        <!-- Hero Image End -->

                        <!-- Hero Client Box Start -->
                        <div class="hero-client-box-gold">
                            <div class="satisfy-client-images">
                                <div class="satisfy-client-image">
                                    <figure class="image-anime">
                                        <img src="{{ \App\Support\SiteMedia::urlOrDefault('sector.host.hero_client_author_1') }}" alt="">
                                    </figure>
                                </div>
                                <div class="satisfy-client-image">
                                    <figure class="image-anime">
                                        <img src="{{ \App\Support\SiteMedia::urlOrDefault('sector.host.hero_client_author_2') }}" alt="">
                                    </figure>
                                </div>
                                <div class="satisfy-client-image">
                                    <figure class="image-anime">
                                        <img src="{{ \App\Support\SiteMedia::urlOrDefault('sector.host.hero_client_author_3') }}" alt="">
                                    </figure>
                                </div>
                            </div>
                            <div class="hero-client-box-content-gold">
                                <p>{{ __('site.host.hero.client_text') }}</p>
                            </div>
                        </div>
                        <!-- Hero Client Box End -->

                        <!-- Hero Video Box Start -->
                        <div class="hero-video-box-gold">
                            <div class="hero-video-image-gold">
                                <figure>
                                    <a href="https://www.youtube.com/watch?v=hDwNapdDdQA" class="popup-video" data-cursor-text="{{ __('site.common.play') }}">
                                        <img src="{{ \App\Support\SiteMedia::urlOrDefault('sector.host.hero_video_poster') }}" alt="{{ __('site.host.hero.brand') }}">
                                    </a>
                                </figure>
                                <div class="video-play-button">
                                    <a href="https://www.youtube.com/watch?v=hDwNapdDdQA" class="popup-video" data-cursor-text="{{ __('site.common.play') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-play" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="hero-video-content-gold">
                                <h3>{{ __('site.host.hero.video_content') }}</h3>
                            </div>
                        </div>
                        <!-- Hero Video Box End -->
                    </div>
                    <!-- Hero Image Box End -->
                </div>
            </div>
        </div>
    </div>

    {{-- About Minh Long Host --}}
    <div class="about-us-gold">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6">
                    <div class="about-us-images-gold wow fadeInUp" data-wow-delay="0.2s">
                        <div class="about-us-image-gold">
                            <figure>
                                <img src="{{ \App\Support\SiteMedia::urlOrDefault('sector.host.about_image') }}" alt="{{ __('site.host.about.title') }}">
                            </figure>
                        </div>
                        <div class="about-us-image-title-gold">
                            <h2>{{ __('site.host.about.image_title') }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="about-us-content-gold">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">{{ __('site.host.about.brand') }}</h3>
                            <h2 class="text-anime-style-3" data-cursor="-opaque">
                                {{ __('site.host.about.headline') }}
                            </h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">
                                {{ __('site.host.about.description') }}
                            </p>
                        </div>

                        <div class="about-us-body-gold wow fadeInUp" data-wow-delay="0.4s">
                            <div class="about-us-hightlighted-content">
                                <h3>{{ __('site.host.about.highlight') }}</h3>
                            </div>
                            <div class="about-body-items-list-gold">
                                <div class="about-us-body-item-gold">
                                    <div class="icon-box">
                                        <img src="{{ asset('frontend') }}/images/icon-about-us-body-item-1.svg" alt="">
                                    </div>
                                    <div class="about-us-body-item-content-gold">
                                        <h3>{{ __('site.host.about.items.item1_title') }}</h3>
                                    </div>
                                </div>
                                <div class="about-us-body-item-gold">
                                    <div class="icon-box">
                                        <img src="{{ asset('frontend') }}/images/icon-about-us-body-item-2.svg" alt="">
                                    </div>
                                    <div class="about-us-body-item-content-gold">
                                        <h3>{{ __('site.host.about.items.item2_title') }}</h3>
                                    </div>
                                </div>
                                <div class="about-us-body-item-gold">
                                    <div class="icon-box">
                                        <img src="{{ asset('frontend') }}/images/icon-about-us-body-item-3.svg" alt="">
                                    </div>
                                    <div class="about-us-body-item-content-gold">
                                        <h3>{{ __('site.host.about.items.item3_title') }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="about-us-footer-gold wow fadeInUp" data-wow-delay="0.6s">
                            <div class="about-us-counter-box-gold">
                                <h2><span class="counter">3</span>+</h2>
                                <p>{{ __('site.host.about.counter') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Services: Urban / Industrial / Social housing --}}
    <div class="our-services-gold">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">{{ __('site.host.services.title') }}</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">
                            {{ __('site.host.services.subtitle') }}
                        </h2>
                    </div>
                </div>
            </div>

            <div class="row services-item-list-gold">
                <div class="col-xl-4 col-md-6">
                    <div class="service-item-gold active wow fadeInUp">
                        <div class="service-item-header-gold">
                            <div class="icon-box">
                                <img src="{{ asset('frontend') }}/images/icon-service-item-gold-1.svg" alt="">
                            </div>
                            <div class="service-item-content-gold">
                                <p>
                                    {{ __('site.host.services.items.item1_desc') }}
                                </p>
                            </div>
                        </div>
                        <div class="service-item-body-gold">
                            <div class="service-item-title-gold">
                                <h2>{{ __('site.host.services.items.item1_title') }}</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="service-item-gold wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-item-header-gold">
                            <div class="icon-box">
                                <img src="{{ asset('frontend') }}/images/icon-service-item-gold-2.svg" alt="">
                            </div>
                            <div class="service-item-content-gold">
                                <p>
                                    {{ __('site.host.services.items.item2_desc') }}
                                </p>
                            </div>
                        </div>
                        <div class="service-item-body-gold">
                            <div class="service-item-title-gold">
                                <h2>{{ __('site.host.services.items.item2_title') }}</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="service-item-gold wow fadeInUp" data-wow-delay="0.4s">
                        <div class="service-item-header-gold">
                            <div class="icon-box">
                                <img src="{{ asset('frontend') }}/images/icon-service-item-gold-3.svg" alt="">
                            </div>
                            <div class="service-item-content-gold">
                                <p>
                                    {{ __('site.host.services.items.item3_desc') }}
                                </p>
                            </div>
                        </div>
                        <div class="service-item-body-gold">
                            <div class="service-item-title-gold">
                                <h2>{{ __('site.host.services.items.item3_title') }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- What We Do: Industrial focus --}}
    <div class="what-we-do-gold">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">{{ __('site.host.what_we_do.eyebrow') }}</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">
                            {{ __('site.host.what_we_do.title') }}
                        </h2>
                    </div>
                </div>
            </div>

            <div class="row align-items-end">
                <div class="col-xl-3 col-md-6">
                    <div class="what-we-item-gold box-1 wow fadeInUp">
                        <div class="what-we-item-header-gold">
                            <div class="what-we-item-title-gold">
                                <h3>{{ __('site.host.what_we_do.item1_title') }}</h3>
                            </div>
                            <div class="icon-box">
                                <img src="{{ asset('frontend') }}/images/icon-what-we-item-1-gold.svg" alt="">
                            </div>
                        </div>
                        <div class="what-we-item-image-gold">
                            <figure class="image-anime">
                                <img src="{{ \App\Support\SiteMedia::urlOrDefault('sector.host.what_we_image_1') }}" alt="">
                            </figure>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="what-we-item-gold box-2 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="what-we-item-header-gold">
                            <div class="what-we-item-shape-image-gold">
                                <figure>
                                    <img src="{{ \App\Support\SiteMedia::urlOrDefault('sector.host.what_we_shape_1') }}" alt="">
                                </figure>
                            </div>
                            <div class="what-we-item-btn-gold">
                                <a href="{{ route('site.contact') }}"><img src="{{ asset('frontend') }}/images/arrow-accent.svg" alt=""></a>
                            </div>
                        </div>
                        <div class="what-we-item-title-gold">
                            <h3>{{ __('site.host.what_we_do.item2_title') }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="what-we-counter-box-gold box-3 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="what-we-item-image-gold">
                            <figure class="image-anime">
                                <img src="{{ \App\Support\SiteMedia::urlOrDefault('sector.host.what_we_image_2') }}" alt="">
                            </figure>
                        </div>
                        <div class="what-we-counter-item-gold">
                            <h2><span class="counter">3</span></h2>
                            <p>{{ __('site.host.what_we_do.counter_text') }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="what-we-item-gold box-4 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="what-we-item-shape-image-gold">
                            <figure>
                                <img src="{{ \App\Support\SiteMedia::urlOrDefault('sector.host.what_we_shape_2') }}" alt="">
                            </figure>
                        </div>
                        <div class="what-we-item-title-gold">
                            <h3>{{ __('site.host.what_we_do.item4_title') }}</h3>
                        </div>
                        <div class="what-we-item-body-gold">
                            <div class="learn-more-circle-gold">
                                <a href="{{ route('site.contact') }}"><img src="{{ asset('frontend') }}/images/learn-more-circle.svg" alt=""></a>
                            </div>
                            <div class="what-we-item-body-image-gold">
                                <img src="{{ \App\Support\SiteMedia::urlOrDefault('sector.host.what_we_body_image') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="what-we-contect-list-gold wow fadeInUp" data-wow-delay="0.4s">
                        <h3>{{ __('site.host.contact.today') }}</h3>
                        <ul>
                            <li><img src="{{ asset('frontend') }}/images/icon-phone-accent.svg" alt=""><a href="tel:{{ preg_replace('/\s+/', '', $settings['contact_phone'] ?? '088 6656 899') }}">{{ $settings['contact_phone'] ?? '088 6656 899' }}</a></li>
                            <li><img src="{{ asset('frontend') }}/images/icon-mail-accent.svg" alt=""><a href="mailto:{{ $settings['contact_email'] ?? 'info@mlgroup.vn' }}">{{ $settings['contact_email'] ?? 'info@mlgroup.vn' }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Key Projects (match Latest Projects structure from index-3) --}}
    <div class="our-projects">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">{{ __('site.host.projects.title') }}</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.host.projects.subtitle') }}</h2>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-4">
                    <div class="section-btn wow fadeInUp" data-wow-delay="0.2s">
                        <a href="{{ route('site.contact') }}" class="btn-default">{{ __('site.host.projects.cta') }}</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="project-item-gold wow fadeInUp">
                        <div class="project-item-image-box-gold">
                            <div class="project-item-image-gold">
                                <a href="{{ route('site.contact') }}" data-cursor-text="{{ __('site.common.view') }}">
                                    <figure class="image-anime">
                                        <img src="{{ \App\Support\SiteMedia::urlOrDefault('sector.host.projects_image_1') }}" alt="{{ __('site.host.projects.project1_title') }}">
                                    </figure>
                                </a>
                            </div>

                            <div class="project-item-tag-gold">
                                <a href="{{ route('site.contact') }}">{{ __('site.host.projects.tag1') }}</a>
                            </div>
                        </div>

                        <div class="project-item-body-gold">
                            <div class="project-item-content-gold">
                                <h2><a href="{{ route('site.contact') }}">{{ __('site.host.projects.project1_title') }}</a></h2>
                            </div>

                            <div class="project-readmore-btn-gold">
                                <a href="{{ route('site.contact') }}"><img src="{{ asset('frontend') }}/images/arrow-accent.svg" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="project-item-gold wow fadeInUp" data-wow-delay="0.2s">
                        <div class="project-item-image-box-gold">
                            <div class="project-item-image-gold">
                                <a href="{{ route('site.contact') }}" data-cursor-text="{{ __('site.common.view') }}">
                                    <figure class="image-anime">
                                        <img src="{{ \App\Support\SiteMedia::urlOrDefault('sector.host.projects_image_2') }}" alt="{{ __('site.host.projects.project2_title') }}">
                                    </figure>
                                </a>
                            </div>

                            <div class="project-item-tag-gold">
                                <a href="{{ route('site.contact') }}">{{ __('site.host.projects.tag2') }}</a>
                            </div>
                        </div>

                        <div class="project-item-body-gold">
                            <div class="project-item-content-gold">
                                <h2><a href="{{ route('site.contact') }}">{{ __('site.host.projects.project2_title') }}</a></h2>
                            </div>

                            <div class="project-readmore-btn-gold">
                                <a href="{{ route('site.contact') }}"><img src="{{ asset('frontend') }}/images/arrow-accent.svg" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Why Choose Us --}}
    <div class="why-choose-us-gold dark-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 order-xl-1 order-2">
                    <div class="why-choose-us-boxes-gold">
                        <div class="why-choose-item-gold">
                            <div class="why-choose-item-image-gold">
                                <figure class="image-anime reveal">
                                    <img src="{{ \App\Support\SiteMedia::urlOrDefault('sector.host.why_choose_image') }}" alt="">
                                </figure>
                            </div>
                            <div class="why-choose-item-body-gold">
                                <div class="why-choose-item-btn-gold">
                                    <a href="{{ route('site.contact') }}"><img src="{{ asset('frontend') }}/images/arrow-white.svg" alt=""></a>
                                </div>
                                <div class="why-choose-item-content-gold">
                                    <h3>{{ __('site.host.why_choose.investor_infra_title') }}</h3>
                                    <p>{{ __('site.host.why_choose.investor_infra_desc') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="why-choose-counter-list-gold wow fadeInUp">
                            <div class="why-choose-counter-item-gold"><h2><span class="counter">3</span>+</h2><p>{{ __('site.host.why_choose.counter1') }}</p></div>
                            <div class="why-choose-counter-item-gold"><h2><span class="counter">30</span>+</h2><p>{{ __('site.host.why_choose.counter2') }}</p></div>
                            <div class="why-choose-counter-item-gold"><h2><span class="counter">120</span>+</h2><p>{{ __('site.host.why_choose.counter3') }}</p></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 order-xl-2 order-1">
                    <div class="why-choose-us-content-gold">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">{{ __('site.host.why_choose.section_title') }}</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">{{ __('site.host.why_choose.subtitle') }}</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">{{ __('site.host.why_choose.description') }}</p>
                        </div>
                        <div class="why-choose-body-gold wow fadeInUp" data-wow-delay="0.4s">
                            <div class="why-choose-body-item-gold">
                                <div class="icon-box"><img src="{{ asset('frontend') }}/images/icon-why-choose-body-item-1-gold.svg" alt=""></div>
                                <div class="why-choose-body-item-content-gold">
                                    <h2>{{ __('site.host.why_choose.governance_title') }}</h2>
                                    <p>{{ __('site.host.why_choose.governance_desc') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="why-choose-us-btn-gold wow fadeInUp" data-wow-delay="0.6s">
                            <a href="{{ route('site.contact') }}" class="btn-default btn-highlighted">{{ __('site.host.why_choose.button') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Our Features --}}
    <div class="our-features-gold">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">{{ __('site.host.features.eyebrow') }}</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.host.features.title') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-md-6"><div class="feature-item-gold wow fadeInUp"><div class="feature-item-content-gold"><h3>{{ __('site.host.features.items.item1_title') }}</h3><p>{{ __('site.host.features.items.item1_desc') }}</p></div><div class="feature-item-image-gold"><figure><img src="{{ \App\Support\SiteMedia::urlOrDefault('sector.host.feature_image_1') }}" alt=""></figure></div></div></div>
                <div class="col-xl-3 col-md-6"><div class="feature-item-gold wow fadeInUp" data-wow-delay="0.2s"><div class="feature-item-content-gold"><h3>{{ __('site.host.features.items.item2_title') }}</h3><p>{{ __('site.host.features.items.item2_desc') }}</p></div><div class="feature-item-image-gold"><figure><img src="{{ \App\Support\SiteMedia::urlOrDefault('sector.host.feature_image_2') }}" alt=""></figure></div></div></div>
                <div class="col-xl-3 col-md-6"><div class="feature-item-gold wow fadeInUp" data-wow-delay="0.4s"><div class="feature-item-content-gold"><h3>{{ __('site.host.features.items.item3_title') }}</h3><p>{{ __('site.host.features.items.item3_desc') }}</p></div><div class="feature-item-image-gold"><figure><img src="{{ \App\Support\SiteMedia::urlOrDefault('sector.host.feature_image_3') }}" alt=""></figure></div></div></div>
                <div class="col-xl-3 col-md-6"><div class="feature-item-gold wow fadeInUp" data-wow-delay="0.6s"><div class="feature-item-content-gold"><h3>{{ __('site.host.features.items.item4_title') }}</h3><p>{{ __('site.host.features.items.item4_desc') }}</p></div><div class="feature-item-image-gold"><figure><img src="{{ \App\Support\SiteMedia::urlOrDefault('sector.host.feature_image_4') }}" alt=""></figure></div></div></div>
            </div>
        </div>
    </div>

    {{-- CTA --}}
    <div class="cta-box-gold">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="cta-box-image-gold"><figure><img src="{{ \App\Support\SiteMedia::urlOrDefault('sector.host.cta_image') }}" alt=""></figure></div>
                </div>
                <div class="col-lg-6">
                    <div class="cta-box-content-gold">
                        <div class="section-title section-title-center">
                            <h3 class="wow fadeInUp">{{ __('site.host.cta_box.title') }}</h3>
                            <h2 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.host.cta_box.headline') }}</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">{{ __('site.host.cta_box.description') }}</p>
                        </div>
                        <div class="cta-box-list-gold wow fadeInUp" data-wow-delay="0.4s">
                            <ul>
                                <li>{{ __('site.host.cta_box.list_item1') }}</li>
                                <li>{{ __('site.host.cta_box.list_item2') }}</li>
                            </ul>
                        </div>
                        <div class="cta-box-btn-gold wow fadeInUp" data-wow-delay="0.6s">
                            <a href="{{ route('site.contact') }}" class="btn-default">{{ __('site.host.cta_box.button') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Intro Video --}}
    <div class="intro-video-gold dark-section parallaxie">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-video-box-gold">
                        <div class="intro-video-header-gold">
                            <div class="section-title">
                                <h3 class="wow fadeInUp">{{ __('site.host.intro_video.title') }}</h3>
                                <h2 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.host.intro_video.subtitle') }}</h2>
                                <p class="wow fadeInUp" data-wow-delay="0.2s">{{ __('site.host.intro_video.description') }}</p>
                            </div>
                            <div class="intro-video-button-gold">
                                <a href="https://www.youtube.com/watch?v=hDwNapdDdQA" class="popup-video" data-cursor-text="{{ __('site.common.play') }}"><img src="{{ asset('frontend') }}/images/intero-video-circle.svg" alt=""></a>
                            </div>
                        </div>
                        <div class="intro-video-counter-box-gold">
                            <div class="intro-video-counter-item-gold"><h2><span class="counter">3</span>+</h2><p>{{ __('site.host.intro_video.counter1') }}</p></div>
                            <div class="intro-video-counter-item-gold"><h2><span class="counter">30</span>+</h2><p>{{ __('site.host.intro_video.counter2') }}</p></div>
                            <div class="intro-video-counter-item-gold"><h2><span class="counter">120</span>+</h2><p>{{ __('site.host.intro_video.counter3') }}</p></div>
                            <div class="intro-video-counter-item-gold"><h2><span class="counter">98</span>%</h2><p>{{ __('site.host.intro_video.counter4') }}</p></div>
                            <div class="intro-video-counter-item-gold"><h2><span class="counter">15</span>+</h2><p>{{ __('site.host.intro_video.counter5') }}</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Pricing block kept for section parity --}}
    <div class="our-pricing-gold">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">{{ __('site.host.development_models.title') }}</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.host.development_models.subtitle') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-md-6"><div class="pricing-item-gold wow fadeInUp"><div class="pricing-item-header-gold"><div class="pricing-item-content-gold"><h3>{{ __('site.host.development_models.model1_title') }}</h3><h2>{{ __('site.host.development_models.model1_phase') }}<sub> /{{ __('site.host.development_models.model1_sub') }}</sub></h2><p>{{ __('site.host.development_models.model1_desc') }}</p></div><div class="pricing-item-btn-gold"><a href="{{ route('site.contact') }}" class="btn-default">{{ __('site.host.development_models.button') }}</a></div></div></div></div>
                <div class="col-xl-4 col-md-6"><div class="pricing-item-gold wow fadeInUp" data-wow-delay="0.2s"><div class="pricing-item-header-gold"><div class="pricing-item-content-gold"><h3>{{ __('site.host.development_models.model2_title') }}</h3><h2>{{ __('site.host.development_models.model2_phase') }}<sub> /{{ __('site.host.development_models.model2_sub') }}</sub></h2><p>{{ __('site.host.development_models.model2_desc') }}</p></div><div class="pricing-item-btn-gold"><a href="{{ route('site.contact') }}" class="btn-default">{{ __('site.host.development_models.button') }}</a></div></div></div></div>
                <div class="col-xl-4 col-md-6"><div class="pricing-item-gold wow fadeInUp" data-wow-delay="0.4s"><div class="pricing-item-header-gold"><div class="pricing-item-content-gold"><h3>{{ __('site.host.development_models.model3_title') }}</h3><h2>{{ __('site.host.development_models.model3_phase') }}<sub> /{{ __('site.host.development_models.model3_sub') }}</sub></h2><p>{{ __('site.host.development_models.model3_desc') }}</p></div><div class="pricing-item-btn-gold"><a href="{{ route('site.contact') }}" class="btn-default">{{ __('site.host.development_models.button') }}</a></div></div></div></div>
            </div>
        </div>
    </div>

    {{-- Testimonials --}}
    <div class="our-testimonials-gold">
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="our-testimonials-content-gold">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">{{ __('site.host.testimonials.title') }}</h3>
                            <h2 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.host.testimonials.subtitle') }}</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">{{ __('site.host.testimonials.description') }}</p>
                        </div>
                        <div class="testimonial-btn-gold wow fadeInUp" data-wow-delay="0.4s">
                            <a href="{{ route('site.contact') }}" class="btn-default">{{ __('site.host.testimonials.cta') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="testimonial-item-box-gold">
                        <div class="testimonial-item-gold wow fadeInUp">
                            <div class="testimonial-item-header-gold">
                                <div class="testimonials-rating-gold">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-star" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15 8.5 22 9.3 17 14 18.2 21 12 17.8 5.8 21 7 14 2 9.3 9 8.5 12 2"></polygon></svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-star" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15 8.5 22 9.3 17 14 18.2 21 12 17.8 5.8 21 7 14 2 9.3 9 8.5 12 2"></polygon></svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-star" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15 8.5 22 9.3 17 14 18.2 21 12 17.8 5.8 21 7 14 2 9.3 9 8.5 12 2"></polygon></svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-star" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15 8.5 22 9.3 17 14 18.2 21 12 17.8 5.8 21 7 14 2 9.3 9 8.5 12 2"></polygon></svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-star" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15 8.5 22 9.3 17 14 18.2 21 12 17.8 5.8 21 7 14 2 9.3 9 8.5 12 2"></polygon></svg>
                                </div>
                                <div class="testimonial-content-gold">
                                    <p>"{{ __('site.host.testimonials.quote1') }}"</p>
                                </div>
                            </div>
                            <div class="testimonial-item-body-gold">
                                <div class="testimonial-author-gold">
                                    <div class="author-image-gold">
                                        <figure class="image-anime">
                                            <img src="{{ \App\Support\SiteMedia::urlOrDefault('sector.host.testimonial_author_1') }}" alt="">
                                        </figure>
                                    </div>
                                    <div class="author-content-gold">
                                        <h3>{{ __('site.host.testimonials.author1') }}</h3>
                                        <p>{{ __('site.host.testimonials.role1') }}</p>
                                    </div>
                                </div>
                                <div class="testimonial-quote-gold">
                                    <img src="{{ asset('frontend') }}/images/testimonial-quote-gold.svg" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="testimonial-item-gold wow fadeInUp" data-wow-delay="0.2s">
                            <div class="testimonial-item-header-gold">
                                <div class="testimonials-rating-gold">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-star" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15 8.5 22 9.3 17 14 18.2 21 12 17.8 5.8 21 7 14 2 9.3 9 8.5 12 2"></polygon></svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-star" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15 8.5 22 9.3 17 14 18.2 21 12 17.8 5.8 21 7 14 2 9.3 9 8.5 12 2"></polygon></svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-star" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15 8.5 22 9.3 17 14 18.2 21 12 17.8 5.8 21 7 14 2 9.3 9 8.5 12 2"></polygon></svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-star" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15 8.5 22 9.3 17 14 18.2 21 12 17.8 5.8 21 7 14 2 9.3 9 8.5 12 2"></polygon></svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-star" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15 8.5 22 9.3 17 14 18.2 21 12 17.8 5.8 21 7 14 2 9.3 9 8.5 12 2"></polygon></svg>
                                </div>
                                <div class="testimonial-content-gold">
                                    <p>"{{ __('site.host.testimonials.quote2') }}"</p>
                                </div>
                            </div>
                            <div class="testimonial-item-body-gold">
                                <div class="testimonial-author-gold">
                                    <div class="author-image-gold">
                                        <figure class="image-anime">
                                            <img src="{{ \App\Support\SiteMedia::urlOrDefault('sector.host.testimonial_author_2') }}" alt="">
                                        </figure>
                                    </div>
                                    <div class="author-content-gold">
                                        <h3>{{ __('site.host.testimonials.author2') }}</h3>
                                        <p>{{ __('site.host.testimonials.role2') }}</p>
                                    </div>
                                </div>
                                <div class="testimonial-quote-gold">
                                    <img src="{{ asset('frontend') }}/images/testimonial-quote-gold.svg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Blog --}}
    <div class="our-blog">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">{{ __('site.host.blog.title') }}</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.host.blog.subtitle') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @include('site.partials.blog-post-cards', ['posts' => $latestBlogPosts ?? collect()])
            </div>
        </div>
    </div>

@endsection

