@php $phone = $settings['contact_phone'] ?? '+123 456 789'; $phoneLink = str_replace(' ', '', $phone); @endphp
<!-- Hero Info Box Start -->
    <div class="hero-info-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Hero Info List Start -->
                    <div class="hero-info-list">
                        <!-- Hero Info Item Start -->
                        <div class="hero-info-item box-1">
                            <!-- Hero Info Content Box Start -->
                            <div class="hero-info-content-box">
                                <div class="hero-info-item-content">
                                    <ul>
                                        <li>MinhLong Group</li>
                                    </ul>
                                    <h3>THE PYRAMID JOURNEY</h3>
                                </div>
                                <div class="hero-info-btn">
                                    <a href="{{ route('site.about') }}" class="readmore-btn">Learn More</a>
                                </div>
                            </div>
                            <!-- Hero Info Content Box End -->
                            
                            <!-- Hero Info Image Start -->
                            <div class="hero-info-image">
                                <figure class="image-anime reveal">
                                    <img src="{{ \App\Support\SiteMedia::urlOrDefault('hero.home.info_1') }}" alt="">
                                </figure>
                            </div>
                            <!-- Hero Info Image End -->
                        </div>
                        <!-- Hero Info Item End -->
        
                        <!-- Hero Info Item Start -->
                        <div class="hero-info-item box-2">
                            <figure class="image-anime reveal">
                                <img src="{{ \App\Support\SiteMedia::urlOrDefault('hero.home.info_2') }}" alt="">
                            </figure>
                        </div>
                        <!-- Hero Info Item End -->
        
                        <!-- Hero Info Item Start -->
                        <div class="hero-info-item box-3">
                            <!-- Hero Info Header Start -->
                            <div class="hero-info-header">
                                <div class="icon-box">
                                    <img src="{{ asset('frontend') }}/images/icon-hero-info-1.svg" alt="">
                                </div>
        
                                <!-- Satisfy Client Images Start -->
                                <div class="satisfy-client-images">
                                    <div class="satisfy-client-image">
                                        <figure class="image-anime">
                                            <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&w=160&q=80" alt="Global partner office">
                                        </figure>
                                    </div>
                                    <div class="satisfy-client-image">
                                        <figure class="image-anime">
                                            <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=160&q=80" alt="Business partner team">
                                        </figure>
                                    </div>
                                    <div class="satisfy-client-image">
                                        <figure class="image-anime">
                                            <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=160&q=80" alt="Corporate partner">
                                        </figure>
                                    </div>
                                    <div class="satisfy-client-image">
                                        <figure class="image-anime">
                                            <img src="https://images.unsplash.com/photo-1520607162513-77705c0f0d4a?auto=format&fit=crop&w=160&q=80" alt="International partner">
                                        </figure>
                                    </div>
                                    <div class="satisfy-client-image">
                                        <figure class="image-anime">
                                            <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=160&q=80" alt="Global company">
                                        </figure>
                                    </div>
                                </div>
                                <!-- Satisfy Client Images End -->
                            </div>
                            <!-- Hero Info Header End -->
        
                            <!-- Hero Info Counter Box Start -->
                            <div class="hero-info-counter-box">
                                <h3>{{ __('site.home.partners') }}</h3>
                                <h2><span class="counter">120</span>+</h2>
                            </div>
                            <!-- Hero Info Counter Box End -->
                            
                            <!-- Hero Info BG Icon Start -->
                            <div class="hero-info-bg-icon">
                                <img src="{{ asset('frontend') }}/images/icon-hero-info-bg-1.svg" alt="">
                            </div>
                            <!-- Hero Info BG Icon End -->
                        </div>
                        <!-- Hero Info Item End -->
                    </div>
                    <!-- Hero Info List End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Info Box End -->

    <!-- About Us Section Start -->
    <div class="about-us">
        <div class="container">
            <div class="row">
                <div class="col-xl-5">
                    <!-- About Us Image Box Start -->
                    <div class="about-us-image-box wow fadeInUp">
                        <!-- About Us Image Box 1 Start -->
                        <div class="about-us-image-box-1">
                            <!-- About Us Image 1 Start -->
                            <div class="about-us-image">
                                <figure class="image-anime">
                                    <img src="{{ \App\Support\SiteMedia::urlOrDefault('home.about.image_1') }}" alt="">
                                </figure>
                            </div>
                            <!-- About Us Image 1 End --> 
                        </div>
                        <!-- About Us Image Box 1 End -->
                        
                        <!-- About Us Image Box 2 Start -->
                         <div class="about-us-image-box-2">
                            <!-- About Us Image 2 Start -->
                            <div class="about-us-image">
                                <figure class="image-anime">
                                    <img src="{{ \App\Support\SiteMedia::urlOrDefault('home.about.image_2') }}" alt="">
                                </figure>
                            </div>
                            <!-- About Us Image 2 End -->
                        
                            <!-- Year Experience Circle Start -->
                            <div class="year-experience-circle">
                                <img src="{{ asset('frontend') }}/images/year-experience-circle-accent.svg" alt="">
                            </div>
                            <!-- Year Experience Circle End -->
                        </div>
                        <!-- About Us Image Box 2 End -->
                    </div>
                    <!-- About Us Image Box End -->
                </div>
                
                <div class="col-xl-7">
                    <!-- About Us Content Start -->
                    <div class="about-us-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">{{ __('site.about.who_we_are') }}</h3>
                            <h2 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.about.headline') }}</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">{{ __('site.about.description') }}</p>
                        </div>
                        <!-- Section Title End -->

                        <!-- About Us Body Start -->
                        <div class="about-us-body wow fadeInUp" data-wow-delay="0.4s">
                            <!-- About Body Item Start -->
                            <div class="about-body-item">
                                <div class="icon-box">
                                    <img src="{{ asset('frontend') }}/images/icon-about-item-1.svg" alt="">
                                </div>
                                <div class="about-body-item-content">
                                    <h3>{{ __('site.about.item1_title') }}</h3>
                                    <p>{{ __('site.about.item1_desc') }}</p>
                                </div>
                            </div>
                            <!-- About Body Item End -->

                            <!-- About Body Item Start -->
                            <div class="about-body-item">
                                <div class="icon-box">
                                    <img src="{{ asset('frontend') }}/images/icon-about-item-2.svg" alt="">
                                </div>
                                <div class="about-body-item-content">
                                    <h3>{{ __('site.about.item2_title') }}</h3>
                                    <p>{{ __('site.about.item2_desc') }}</p>
                                </div>
                            </div>
                            <!-- About Body Item End -->
                        </div>
                        <!-- About Us Body End -->

                        <!-- About Us Footer Start -->
                        <div class="about-us-footer wow fadeInUp" data-wow-delay="0.6s">
                            <!-- About Us Footer Content Start -->
                            <div class="about-us-footer-content">
                                <!-- About Footer Content List Start -->
                                <div class="about-footer-content-list">
                                    <ul>
                                        @foreach (__('site.about.footer_list') as $line)
                                            <li>{{ $line }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- About Footer Content List End -->

                                <div class="about-us-footer-actions wow fadeInUp" data-wow-delay="0.65s">
                                    <p class="about-audio-block__title">{{ __('site.home.about_section.audio_title') }}</p>
                                    <div class="about-us-footer-actions__row">
                                        <div class="about-audio-block">
                                            <audio id="home-about-audio" preload="metadata" src="{{ asset('frontend/audio/minhlong.mp3') }}"></audio>
                                            <button
                                                type="button"
                                                id="home-about-audio-toggle"
                                                class="btn-default about-audio-toggle"
                                                aria-pressed="false"
                                                aria-controls="home-about-audio"
                                                aria-label="{{ __('site.home.about_section.audio_toggle_aria') }}"
                                            >
                                                <span class="about-audio-toggle__icon-play" aria-hidden="true">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                                                </span>
                                                <span class="about-audio-toggle__icon-pause" aria-hidden="true">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="6" y="4" width="4" height="16"></rect><rect x="14" y="4" width="4" height="16"></rect></svg>
                                                </span>
                                                <span class="about-audio-toggle__text-play">{{ __('site.home.about_section.audio_play') }}</span>
                                                <span class="about-audio-toggle__text-pause">{{ __('site.home.about_section.audio_pause') }}</span>
                                            </button>
                                        </div>
                                        <div class="about-us-btn">
                                            <a href="{{ route('site.about') }}" class="btn-default">{{ __('site.home.about_section.more_about_us') }}</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- About Us actions row End -->
                            </div>
                            <!-- About Us Footer Content End -->

                            <!-- About Us Video Box Start -->
                            <div class="about-us-video-box">
                                <!-- Intro Video Image Start -->
                                <div class="about-video-image">
                                    <figure class="image-anime">
                                        <img src="{{ \App\Support\SiteMedia::urlOrDefault('home.about.video_poster') }}" alt="">
                                    </figure>
                                </div>
                                <!-- Intro Video Image End -->
                                
                                <!-- Video Play Button Start -->
                                <div class="video-play-button">
                                    <a href="https://www.youtube.com/watch?v=hDwNapdDdQA" class="popup-video" data-cursor-text="Play">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-play" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                        </svg>
                                    </a>
                                </div>
                                <!-- Video Play Button End -->
                            </div>
                            <!-- About Us Video Box End -->
                        </div>
                        <!-- About Us Footer End -->
                    </div>
                    <!-- About Us Content End -->
                </div>
            </div>
        </div>
    </div> 
    <!-- About Us Section End -->

    <!-- Our Services Section Start -->
    <div class="our-services">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">{{ __('site.home.services_section.title') }}</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.home.services_section.subtitle') }}</h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>
            
            @php
                $homeServiceSectors = [
                    ['route' => 'site.land', 'image' => \App\Support\SiteMedia::urlOrDefault('home.services.land'), 'delay' => null, 'active' => 'active', 'image_full' => true],
                    ['route' => 'site.host', 'image' => \App\Support\SiteMedia::urlOrDefault('home.services.host'), 'delay' => '0.2s', 'active' => '', 'image_full' => true],
                    ['route' => 'site.minerals', 'image' => \App\Support\SiteMedia::urlOrDefault('home.services.minerals'), 'delay' => '0.4s', 'active' => '', 'image_full' => false],
                    ['route' => 'site.power', 'image' => \App\Support\SiteMedia::urlOrDefault('home.services.power'), 'delay' => '0.6s', 'active' => '', 'image_full' => false],
                ];
            @endphp
            <div class="row services-item-list">
                @foreach ($homeServiceSectors as $index => $sector)
                <div class="col-xl-3 col-md-6">
                    <!-- Services Item Start -->
                    <div @class([
                        'service-item',
                        'wow',
                        'fadeInUp',
                        $sector['active'],
                        'service-item--home-image-full' => ! empty($sector['image_full']),
                    ])@if ($sector['delay']) data-wow-delay="{{ $sector['delay'] }}"@endif>
                        <div class="service-item-header">
                            <div class="service-item-title">
                                <div class="service-item-heading">
                                    <h2><a href="{{ route($sector['route']) }}">{{ __('site.home.services_section.items.'.$index.'.title') }}</a></h2>
                                    <p class="service-item-pillar-label">{{ __('site.home.services_section.items.'.$index.'.pillar_label') }}</p>
                                </div>
                                <h3>0{{ $index + 1 }}.</h3>
                            </div>
                            <div class="service-item-content">
                                <p>{{ __('site.home.services_section.items.'.$index.'.desc') }}</p>
                            </div>
                        </div>
                        <div class="service-image-box">
                            <div class="service-item-image">
                                <figure class="image-anime">
                                    <img src="{{ $sector['image'] }}" alt="{{ __('site.home.services_section.items.'.$index.'.title') }}">
                                </figure>
                            </div>
                            <div class="service-item-btn">
                                <a href="{{ route($sector['route']) }}">
                                    <img src="{{ asset('frontend') }}/images/arrow-primary.svg" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Services Item End -->
                </div>
                @endforeach

                <div class="col-lg-12">
                    <!-- Service Benefit Box Start -->
                    <div class="service-benefit-box wow fadeInUp" data-wow-delay="0.4s">
                        <!-- Service Benefit List Start -->
                        <div class="service-benefit-list">
                            <ul>
                                <li>{{ __('site.home.services_section.benefits.0') }}</li>
                                <li>{{ __('site.home.services_section.benefits.1') }}</li>
                                <li>{{ __('site.home.services_section.benefits.2') }}</li>
                                <li>{{ __('site.home.services_section.benefits.3') }}</li>
                            </ul>
                        </div>
                        <!-- Service Benefit List End -->

                        <!-- Section Footer Text Start -->
                        <div class="section-footer-text">
                            <p><span>{{ __('site.home.services_section.free_prefix') }}</span>{{ __('site.home.services_section.free_text') }} <a href="{{ route('site.contact') }}">{{ __('site.home.services_section.free_quote_link') }}</a></p>
                        </div>
                        <!-- Section Footer Text End -->
                    </div>
                    <!-- Service Benefit Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Our Services Section End -->

    <!-- What We Do Setion Start -->
    <div class="what-we-do">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-xl-7">
                    <!-- What We Do Content Start -->
                    <div class="what-we-do-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">{{ __('site.home.what_we_do_section.eyebrow') }}</h3>
                            <h2 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.home.what_we_do_section.title') }}</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">{{ __('site.home.what_we_do_section.description') }}</p>
                        </div>
                        <!-- Section Title End -->

                        <!-- What We Do Iteam List Start -->
                        <div class="what-we-do-item-list wow fadeInUp" data-wow-delay="0.4s">
                            <!-- What We Do Item Start -->
                            <div class="what-we-do-item">
                                <div class="icon-box">
                                    <img src="{{ asset('frontend') }}/images/icon-what-we-do-item-1.svg" alt="">
                                </div>
                                <div class="what-we-do-item-body">
                                    <h3>{{ __('site.home.what_we_do_section.item1_title') }}</h3>
                                    <p>{{ __('site.home.what_we_do_section.item1_desc') }}</p>
                                    <ul>
                                        <li>{{ __('site.home.what_we_do_section.item1_bullet') }}</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- What We Do Item End -->

                            <!-- What We Do Item Start -->
                            <div class="what-we-do-item">
                                <div class="icon-box">
                                    <img src="{{ asset('frontend') }}/images/icon-what-we-do-item-2.svg" alt="">
                                </div>
                                <div class="what-we-do-item-body">
                                    <h3>{{ __('site.home.what_we_do_section.item2_title') }}</h3>
                                    <p>{{ __('site.home.what_we_do_section.item2_desc') }}</p>
                                    <ul>
                                        <li>{{ __('site.home.what_we_do_section.item2_bullet') }}</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- What We Do Item End -->
                        </div> 
                        <!-- What We Do Iteam List End -->

                        <!-- What We Do Button Start -->
                        <div class="what-we-do-btn wow fadeInUp" data-wow-delay="0.6s">
                            <button type="button" class="btn-default btn-profile-download" data-bs-toggle="modal" data-bs-target="#profileDownloadModal">
                                {{ __('site.home.what_we_do_section.profile_download_button') }}
                            </button>
                        </div>
                        <!-- What We Do Button End -->

                        <!-- Profile PDFs modal -->
                        <div class="modal fade" id="profileDownloadModal" tabindex="-1" aria-labelledby="profileDownloadModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                                <div class="modal-content profile-download-modal">
                                    <div class="modal-header profile-download-modal__header">
                                        <h5 class="modal-title profile-download-modal__title" id="profileDownloadModalLabel">{{ __('site.home.what_we_do_section.profile_download_modal_title') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('site.home.what_we_do_section.profile_download_close') }}"></button>
                                    </div>
                                    <div class="modal-body profile-download-modal__body">
                                        @php
                                            $profileDocsWithFile = ($profileDocuments ?? collect())->filter(
                                                fn ($d) => $d->hasDownloadTarget()
                                            );
                                        @endphp
                                        @if ($profileDocsWithFile->isEmpty())
                                            <p class="profile-download-modal__empty mb-0">{{ __('site.home.what_we_do_section.profile_download_empty') }}</p>
                                        @else
                                            @foreach ($profileDocsWithFile as $doc)
                                                <div class="profile-download-row">
                                                    <div class="profile-download-row__main">
                                                        <span class="profile-download-row__icon" aria-hidden="true">
                                                            {{-- Lucide file-text --}}
                                                            <svg class="lucide lucide-file-text" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                                                                <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                                                                <path d="M10 9H8" />
                                                                <path d="M16 13H8" />
                                                                <path d="M16 17H8" />
                                                            </svg>
                                                        </span>
                                                        <span class="profile-download-row__name">{{ $doc->title }}</span>
                                                    </div>
                                                    <a
                                                        href="{{ $doc->publicDownloadHref() }}"
                                                        class="btn-default-download profile-download-row__cta"
                                                        @if ($doc->isExternalLink()) target="_blank" rel="noopener noreferrer" @endif
                                                    >
                                                        <span class="profile-download-row__cta-label">{{ __('site.library.download') }}</span>
                                                        <span class="profile-download-row__cta-icon" aria-hidden="true">
                                                            {{-- Lucide download --}}
                                                            <svg class="lucide lucide-download" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                                                <polyline points="7 10 12 15 17 10" />
                                                                <line x1="12" y1="15" x2="12" y2="3" />
                                                            </svg>
                                                        </span>
                                                    </a>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- What We Do Content End -->
                </div>

                <div class="col-xl-5">
                    <!-- What We Do Image Start -->
                    <div class="what-we-do-image wow fadeInUp" data-wow-delay="0.2s">
                        <figure>
                            <img src="{{ asset('frontend') }}/images/what-we-do-image.png" alt="">
                        </figure>
                    </div>
                    <!-- What We Do Image End -->
                </div>
            </div>

            <div class="col-lg-12">
                <!-- Section Footer Text Start -->
                <div class="section-footer-text section-satisfy-img wow fadeInUp" data-wow-delay="0.4s">
                    <!-- Satisfy Client Images Start -->
                    <div class="satisfy-client-images">
                        <div class="satisfy-client-image">
                            <figure class="image-anime">
                                <img src="{{ asset('frontend') }}/images/author-1.jpg" alt="">
                            </figure>
                        </div>
                        <div class="satisfy-client-image add-more">
                            <img src="{{ asset('frontend') }}/images/icon-phone-primary.svg" alt="">
                        </div>
                    </div>
                    <!-- Satisfy Client Images End -->
                    <p>{{ __('site.home.features_section.trusted_description') }}</p>
                </div>
                <!-- Section Footer Text End -->
            </div>
        </div>
    </div>
    <!-- What We Do Setion End -->

    <!-- Watch Our Story Section Start -->
    <div class="our-story our-story-home-bg dark-section parallaxie">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Our Story Content Start -->
                    <div class="our-story-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">{{ __('site.home.story_section.title') }}</h3>
                            <h2 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.home.story_section.subtitle') }}</h2>
                        </div>
                        <!-- Section Title End -->

                        <!-- Watch Video Circle Start -->
                        <div class="watch-video-circle">
                            <a href="https://www.youtube.com/watch?v=4hWRk3EEybA" class="popup-video" data-cursor-text="Play">
                                <img src="{{ asset('frontend') }}/images/watch-video-circle.svg" alt="">
                            </a>
                        </div>
                        <!-- Watch Video Circle End -->
                    </div>
                    <!-- Our Story Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Watch Our Story Section End -->

    <!-- Our Features Section Start -->
    <div class="our-features">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">{{ __('site.home.features_section.title') }}</h3>
                        <h2 class="text-effect" data-cursor="-opaque">
                            {{ __('site.home.features_section.subtitle_part1') }}
                            <span class="feature-title-img-1"><img src="{{ asset('frontend') }}/images/icon-feature-title-1.svg" alt=""></span>
                            {{ __('site.home.features_section.subtitle_part2') }}
                            <span class="feature-title-img-2"><img src="{{ asset('frontend') }}/images/icon-feature-title-2.svg" alt=""></span>
                            {{ __('site.home.features_section.subtitle_part3') }}
                            <span class="feature-title-img-3"><img src="{{ asset('frontend') }}/images/author-1.jpg" alt=""><img src="{{ asset('frontend') }}/images/author-2.jpg" alt=""><img src="{{ asset('frontend') }}/images/author-3.jpg" alt=""></span>
                            {{ __('site.home.features_section.subtitle_part4') }}
                        </h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">
                <div class="col-xl-4 col-md-6 order-1">
                    <!-- Feature Item Start -->
                    <div class="feature-item box-1 wow fadeInUp">
                        <div class="feature-item-shape-image">
                            <figure>
                                <img src="{{ asset('frontend') }}/images/feature-item-image-1.jpg" alt="">
                            </figure>
                        </div>
                        <div class="feature-item-content-box">
                            <div class="feature-item-content">
                                <h3>{{ __('site.home.features_section.items.item1.title') }}</h3>
                                <p>{{ __('site.home.features_section.items.item1.desc') }}</p>
                            </div>
                            <div class="feature-item-list">
                                <ul>
                                    <li>{{ __('site.home.features_section.items.item1.bullets.0') }}</li>
                                    <li>{{ __('site.home.features_section.items.item1.bullets.1') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Feature Item End -->
                </div>

                <div class="col-xl-4 order-xl-2 order-md-3 order-2">
                    <!-- Feature Item Start -->
                    <div class="feature-item box-2 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="feature-item-info">
                            <div class="feature-item-info-content">
                                <p>{{ __('site.home.features_section.items.item2.badge') }}</p>
                                <h3>{{ __('site.home.features_section.items.item2.title') }}</h3>
                            </div>
                            <div class="feature-item-btn">
                                <a href="{{ route('site.contact') }}" class="readmore-btn">{{ __('site.home.features_section.items.item2.button') }}</a>
                            </div>
                        </div>
                        <div class="feature-item-image">
                            <figure>
                                <img src="{{ asset('frontend') }}/images/feature-item-image-2.png" alt="">
                            </figure>
                        </div>
                    </div>
                    <!-- Feature Item End -->
                </div>

                <div class="col-xl-4 col-md-6 order-xl-3 order-md-2 order-3">
                    <!-- Feature Item Start -->
                    <div class="feature-item box-3 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="feature-item-content-box">
                            <div class="feature-item-content">
                                <h2><span class="counter">300</span>+</h2>
                                <h3>{{ __('site.home.features_section.items.item3.title') }}</h3>
                            </div>
                            <div class="feature-item-counter-info">
                                <p>{{ __('site.home.features_section.items.item3.desc') }}</p>
                            </div>
                        </div>
                        <div class="feature-item-tag-list">
                            <ul>
                                    <li>{{ __('site.home.features_section.items.item3.tags.0') }}</li>
                                    <li>{{ __('site.home.features_section.items.item3.tags.1') }}</li>
                            </ul>
                        </div>
                    </div>
                    <!-- Feature Item End -->
                </div>

                <div class="col-lg-12 order-5">
                    <!-- Section Footer Text Start -->
                    <div class="section-footer-text section-satisfy-img wow fadeInUp" data-wow-delay="0.6s">
                        <!-- Satisfy Client Images Start -->
                        <div class="satisfy-client-images">
                            <div class="satisfy-client-image">
                                <figure class="image-anime">
                                    <img src="{{ asset('frontend') }}/images/author-1.jpg" alt="">
                                </figure>
                            </div>
                            <div class="satisfy-client-image add-more">
                                <img src="{{ asset('frontend') }}/images/icon-phone-primary.svg" alt="">
                            </div>
                        </div>
                        <!-- Satisfy Client Images End -->
                        <p>{{ __('site.home.features_section.trusted_description') }}</p>
                        <ul>
                            <li><span class="counter">4.9</span>/5</li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-star" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="none">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-star" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="none">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-star" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="none">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-star" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="none">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-star" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="none">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                </svg>
                            </li>
                            <li>{{ __('site.home.features_section.trusted_by') }}</li>
                        </ul>
                    </div>
                    <!-- Section Footer Text End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Our Features Section End -->

    <!-- Our Projects Section Start -->
    <div class="our-projects">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-xl-6">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">{{ __('site.home.projects_section.title') }}</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.home.projects_section.subtitle') }}</h2>
                    </div>
                    <!-- Section Title End -->
                </div>

                <div class="col-xl-6">
                    <!-- Section Content Button Start -->
                    <div class="section-content-btn">
                        <!-- Section Title Content Start -->
                        <div class="section-title-content wow fadeInUp" data-wow-delay="0.2s">
                            <p>{{ __('site.home.projects_section.content') }}</p>
                        </div>
                        <!-- Section Title Content End -->
    
                        <!-- Section Button Start -->
                        <div class="section-btn wow fadeInUp" data-wow-delay="0.4s">
                            <a href="{{ route('site.contact') }}" class="btn-default">{{ __('site.home.projects_section.button') }}</a>
                        </div>
                        <!-- Section Button End -->
                    </div>   
                    <!-- Section Content Button End -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- Our Gallery Nav start -->
                    <div class="project-nav wow fadeInUp" data-wow-delay="0.2s">
                        <ul>
                            <li><a href="#" data-filter="*">{{ __('site.home.projects_section.filters.all') }}</a></li>
                            <li><a href="#" class="active-btn" data-filter=".first">{{ __('site.home.projects_section.filters.factories') }}</a></li>
                            <li><a href="#" data-filter=".second">{{ __('site.home.projects_section.filters.industrial_zones') }}</a></li>
                            <li><a href="#" data-filter=".third">{{ __('site.home.projects_section.filters.warehouse_logistics') }}</a></li>
                            <li><a href="#" data-filter=".fourth">{{ __('site.home.projects_section.filters.mep_utilities') }}</a></li>
                        </ul>
                    </div>
                    <!-- Our Gallery Nav End -->
                </div>

                <div class="col-lg-12">
                    <!-- Project Item List Start -->
                    <div class="row project-item-list wow fadeInUp" data-wow-delay="0.4s">
                        <!-- Project Item Start -->
                        <div class="col-xl-4 col-md-6 project-item-box first third">
                            <div class="project-item active">
                                <!-- Project Item Image Start -->
                                <div class="project-item-image">
                                    <a href="project-single.html" data-cursor-text="View">
                                        <figure class="image-anime">
                                            <img src="{{ asset('frontend') }}/images/project-image-1.jpg" alt="">
                                        </figure>
                                    </a>
                                </div>
                                <!-- Project Item Image End -->
                                
                                <!-- Project Item Content Start -->
                                <div class="project-item-content">
                                    <h2><a href="project-single.html">Phu My Precision Factory</a></h2>
                                    <p>{{ __('site.home.projects_section.categories.factory_construction') }}</p>
                                </div>
                                <!-- Project Item Content End -->
                                
                                <!-- Project Item Button Start -->
                                <div class="project-item-btn">
                                    <a href="project-single.html">
                                        <img src="{{ asset('frontend') }}/images/arrow-white.svg" alt="">
                                    </a>
                                </div>
                                <!-- Project Item Button End -->
                            </div>
                        </div>
                        <!-- Project Item End -->

                        <!-- Project Item Start -->
                        <div class="col-xl-4 col-md-6 project-item-box first fourth">
                            <div class="project-item">
                                <!-- Project Item Image Start -->
                                <div class="project-item-image">
                                    <a href="project-single.html" data-cursor-text="View">
                                        <figure class="image-anime">
                                            <img src="{{ asset('frontend') }}/images/project-image-2.jpg" alt="">
                                        </figure>
                                    </a>
                                </div>
                                <!-- Project Item Image End -->
                                
                                <!-- Project Item Content Start -->
                                <div class="project-item-content">
                                    <h2><a href="project-single.html">Hai Phong M&amp;E Utility Upgrade</a></h2>
                                    <p>{{ __('site.home.projects_section.categories.me_systems') }}</p>
                                </div>
                                <!-- Project Item Content End -->
                                
                                <!-- Project Item Button Start -->
                                <div class="project-item-btn">
                                    <a href="project-single.html">
                                        <img src="{{ asset('frontend') }}/images/arrow-white.svg" alt="">
                                    </a>
                                </div>
                                <!-- Project Item Button End -->
                            </div>
                        </div>
                        <!-- Project Item End -->

                        <!-- Project Item Start -->
                        <div class="col-xl-4 col-md-6 project-item-box first third">
                            <div class="project-item">
                                <!-- Project Item Image Start -->
                                <div class="project-item-image">
                                    <a href="project-single.html" data-cursor-text="View">
                                        <figure class="image-anime">
                                            <img src="{{ asset('frontend') }}/images/project-image-3.jpg" alt="">
                                        </figure>
                                    </a>
                                </div>
                                <!-- Project Item Image End -->
                                
                                <!-- Project Item Content Start -->
                                <div class="project-item-content">
                                    <h2><a href="project-single.html">Bac Ninh Electronics Plant</a></h2>
                                    <p>{{ __('site.home.projects_section.categories.turnkey_industrial_plant') }}</p>
                                </div>
                                <!-- Project Item Content End -->
                                
                                <!-- Project Item Button Start -->
                                <div class="project-item-btn">
                                    <a href="project-single.html">
                                        <img src="{{ asset('frontend') }}/images/arrow-white.svg" alt="">
                                    </a>
                                </div>
                                <!-- Project Item Button End -->
                            </div>
                        </div>
                        <!-- Project Item End -->

                        <!-- Project Item Start -->
                        <div class="col-xl-4 col-md-6 project-item-box second fourth">
                            <div class="project-item">
                                <!-- Project Item Image Start -->
                                <div class="project-item-image">
                                    <a href="project-single.html" data-cursor-text="View">
                                        <figure class="image-anime">
                                            <img src="{{ asset('frontend') }}/images/project-image-4.jpg" alt="">
                                        </figure>
                                    </a>
                                </div>
                                <!-- Project Item Image End -->
                                
                                <!-- Project Item Content Start -->
                                <div class="project-item-content">
                                    <h2><a href="project-single.html">Long An Steel Fabrication Workshop</a></h2>
                                    <p>{{ __('site.home.projects_section.categories.steel_structure_workshop') }}</p>
                                </div>
                                <!-- Project Item Content End -->
                                
                                <!-- Project Item Button Start -->
                                <div class="project-item-btn">
                                    <a href="project-single.html">
                                        <img src="{{ asset('frontend') }}/images/arrow-white.svg" alt="">
                                    </a>
                                </div>
                                <!-- Project Item Button End -->
                            </div>
                        </div>
                        <!-- Project Item End -->

                        <!-- Project Item Start -->
                        <div class="col-xl-4 col-md-6 project-item-box second third">
                            <div class="project-item">
                                <!-- Project Item Image Start -->
                                <div class="project-item-image">
                                    <a href="project-single.html" data-cursor-text="View">
                                        <figure class="image-anime">
                                            <img src="{{ asset('frontend') }}/images/project-image-5.jpg" alt="">
                                        </figure>
                                    </a>
                                </div>
                                <!-- Project Item Image End -->
                                
                                <!-- Project Item Content Start -->
                                <div class="project-item-content">
                                    <h2><a href="project-single.html">Binh Duong Logistics Distribution Center</a></h2>
                                    <p>{{ __('site.home.projects_section.categories.warehouse_logistics_facility') }}</p>
                                </div>
                                <!-- Project Item Content End -->
                                
                                <!-- Project Item Button Start -->
                                <div class="project-item-btn">
                                    <a href="project-single.html">
                                        <img src="{{ asset('frontend') }}/images/arrow-white.svg" alt="">
                                    </a>
                                </div>
                                <!-- Project Item Button End -->
                            </div>
                        </div>
                        <!-- Project Item End -->

                        <!-- Project Item Start -->
                        <div class="col-xl-4 col-md-6 project-item-box second fourth">
                            <div class="project-item">
                                <!-- Project Item Image Start -->
                                <div class="project-item-image">
                                    <a href="project-single.html" data-cursor-text="View">
                                        <figure class="image-anime">
                                            <img src="{{ asset('frontend') }}/images/project-image-6.jpg" alt="">
                                        </figure>
                                    </a>
                                </div>
                                <!-- Project Item Image End -->
                                
                                <!-- Project Item Content Start -->
                                <div class="project-item-content">
                                    <h2><a href="project-single.html">Dong Nai Fire Protection Retrofit</a></h2>
                                    <p>{{ __('site.home.projects_section.categories.fire_protection_upgrade') }}</p>
                                </div>
                                <!-- Project Item Content End -->
                                
                                <!-- Project Item Button Start -->
                                <div class="project-item-btn">
                                    <a href="project-single.html">
                                        <img src="{{ asset('frontend') }}/images/arrow-white.svg" alt="">
                                    </a>
                                </div>
                                <!-- Project Item Button End -->
                            </div>
                        </div>
                        <!-- Project Item End -->
                    </div>
                    <!-- Project Item List End -->
                </div>

                <div class="col-lg-12">
                    <!-- Section Footer Text Start -->
                    <div class="section-footer-text section-satisfy-img wow fadeInUp" data-wow-delay="0.4s">
                        <!-- Satisfy Client Images Start -->
                        <div class="satisfy-client-images">
                            <div class="satisfy-client-image">
                                <figure class="image-anime">
                                    <img src="{{ asset('frontend') }}/images/author-1.jpg" alt="">
                                </figure>
                            </div>
                            <div class="satisfy-client-image">
                                <figure class="image-anime">
                                    <img src="{{ asset('frontend') }}/images/author-2.jpg" alt="">
                                </figure>
                            </div>
                            <div class="satisfy-client-image">
                                <figure class="image-anime">
                                    <img src="{{ asset('frontend') }}/images/author-3.jpg" alt="">
                                </figure>
                            </div>
                        </div>
                        <!-- Satisfy Client Images End -->    
                        <p>Need an EPC contractor for your industrial-zone factory project? <a href="tel:{{ $phoneLink }}">Call Us: {{ $phone }}</a></p>
                    </div>
                    <!-- Section Footer Text End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Our Projects Section End -->

    <!-- CTA Box Section Start -->
    <div class="cta-box cta-box-home-bg dark-section parallaxie">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- CTA Box Content Start -->
                    <div class="cta-box-content cta-box-content--home">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">{{ __('site.home.cta_box.title') }}</h3>
                            <h2 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.home.cta_box.subtitle') }}</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">{{ __('site.home.cta_box.description') }}</p>
                        </div>
                        <!-- Section Title End -->
                    
                        <!-- CTA Box Items List Start -->
                        <div class="cta-box-items-list wow fadeInUp" data-wow-delay="0.4s">
                            <!-- CTA Box Item Start -->
                            <div class="cta-box-item">
                                <div class="icon-box">
                                    <img src="{{ asset('frontend') }}/images/icon-cta-box-item-1.svg" alt="">
                                </div>
                                <div class="cta-box-item-content">
                                    <h3>{{ __('site.home.cta_box.item1') }}</h3>
                                </div>
                            </div>
                            <!-- CTA Box Item End -->

                            <!-- CTA Box Item Start -->
                            <div class="cta-box-item">
                                <div class="icon-box">
                                    <img src="{{ asset('frontend') }}/images/icon-cta-box-item-2.svg" alt="">
                                </div>
                                <div class="cta-box-item-content">
                                    <h3>{{ __('site.home.cta_box.item2') }}</h3>
                                </div>
                            </div>
                            <!-- CTA Box Item End -->
                        </div>
                        <!-- CTA Box Items List End -->

                        <!-- CTA Box Btn Start -->
                        <div class="cta-box-btn wow fadeInUp" data-wow-delay="0.6s">
                            <a href="tel:{{ $phoneLink }}" class="btn-default btn-highlighted">{{ __('site.home.cta_box.call_prefix') }}: {{ $phone }}</a>  
                        </div>
                        <!-- CTA Box Btn End -->
                    </div> 
                    <!-- CTA Box Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- CTA Box Section End -->

    <!-- Our FAQs Section Start -->
    <div class="our-faqs">
        <div class="container">
            <div class="row">
                <div class="col-xl-5">
                    <!-- Our FAQs Content Start -->
                    <div class="our-faqs-content">
                        <!-- Faqs Title Box Start -->
                        <div class="faqs-title-box">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h3 class="wow fadeInUp">{{ __('site.home.faqs.title') }}</h3>
                                <h2 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.home.faqs.subtitle') }}</h2>
                                <p class="wow fadeInUp" data-wow-delay="0.2s">{{ __('site.home.faqs.description') }}</p>
                            </div>
                            <!-- Section Title End -->

                            <!-- Our FAQs Button Start -->
                            <div class="our-faqs-btn wow fadeInUp" data-wow-delay="0.4s">
                                <a href="{{ route('site.contact') }}" class="btn-default">{{ __('site.home.faqs.button') }}</a>   
                            </div>
                            <!-- Our FAQs Button End -->
                        </div>
                        <!-- Faqs Title Box End -->

                        <!-- Faq Contact Box Start -->
                        <div class="faq-contact-box wow fadeInUp" data-wow-delay="0.6s">
                            <div class="icon-box">
                                <img src="{{ asset('frontend') }}/images/icon-phone-primary.svg" alt="">
                            </div>
                            <div class="faq-contact-box-content">
                                <h3>{{ __('site.home.faqs.contact_title') }}</h3>
                                <p><a href="tel:{{ $phoneLink }}">{{ $phone }}</a></p>
                            </div>
                        </div>
                        <!-- Faq Contact Box End -->
                    </div>
                    <!-- Our FAQs Content End -->
                </div>

                <div class="col-xl-7">
                    <!-- FAQ Accordion Start -->
                    <div class="faq-accordion" id="accordion">
                        <!-- FAQ Item Start -->
                        <div class="accordion-item wow fadeInUp">
                            <h2 class="accordion-header" id="heading1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                    {{ __('site.home.faqs.q1') }}
                                </button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse collapse  show" aria-labelledby="heading1" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <p>{{ __('site.home.faqs.a1') }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- FAQ Item End -->

                        <!-- FAQ Item Start -->
                        <div class="accordion-item wow fadeInUp" data-wow-delay="0.2s">
                            <h2 class="accordion-header" id="heading2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                    {{ __('site.home.faqs.q2') }}
                                </button>
                            </h2>
                            <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <p>{{ __('site.home.faqs.a2') }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- FAQ Item End -->

                        <!-- FAQ Item Start -->
                        <div class="accordion-item wow fadeInUp" data-wow-delay="0.4s">
                            <h2 class="accordion-header" id="heading3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                    {{ __('site.home.faqs.q3') }}
                                </button>
                            </h2>
                            <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <p>{{ __('site.home.faqs.a3') }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- FAQ Item End -->

                        <!-- FAQ Item Start -->
                        <div class="accordion-item wow fadeInUp" data-wow-delay="0.6s">
                            <h2 class="accordion-header" id="heading4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                    {{ __('site.home.faqs.q4') }}
                                </button>
                            </h2>
                            <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <p>{{ __('site.home.faqs.a4') }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- FAQ Item End -->
                        
                        <!-- FAQ Item Start -->
                        <div class="accordion-item wow fadeInUp" data-wow-delay="0.8s">
                            <h2 class="accordion-header" id="heading5">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                    {{ __('site.home.faqs.q5') }}
                                </button>
                            </h2>
                            <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <p>{{ __('site.home.faqs.a5') }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- FAQ Item End -->
                    </div>
                    <!-- FAQ Accordion End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Our FAQs Section End -->

    <!-- Our Testimonials Section Start -->
    <div class="our-testimonials">
        <div class="container">
            <div class="row">
                <div class="col-xl-5">
                    <!-- Testimonial Content Start -->
                    <div class="our-testimonial-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">{{ __('site.home.testimonials_section.title') }}</h3>
                            <h2 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.home.testimonials_section.subtitle') }}</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">{{ __('site.home.testimonials_section.description') }}</p>
                        </div>
                        <!-- Section Title End -->

                        <!-- Testimonial Button Start -->
                        <div class="testimonial-btn wow fadeInUp" data-wow-delay="0.4s">
                            <a href="{{ route('site.contact') }}" class="btn-default">{{ __('site.home.testimonials_section.button') }}</a>
                        </div>
                        <!-- Testimonial Button End -->
                    </div>
                    <!-- Testimonial Content End -->
                </div>
                
                <div class="col-xl-7">
                    <!-- Testimonial Slider Box Start -->
                    <div class="testimonial-slider-box">
                        <!-- Testimonial Slider Start -->
                        <div class="testimonial-slider">
                            <div class="swiper">
                                <div class="swiper-wrapper" data-cursor-text="Drag">
                                    <!-- Testimonial Slide Start -->
                                    <div class="swiper-slide">
                                        <!-- Testimonial Item Start -->
                                        <div class="testimonial-item">
                                            <div class="testimonial-company-logo">
                                                <img src="{{ asset('frontend') }}/images/company-logo-1.svg" alt="">
                                            </div> 
                                            <div class="testimonial-item-body">
                                                <div class="testimonial-item-content">
                                                    <p>"Minh Long delivered our factory package on schedule with strong safety discipline. Coordination between civil and M&amp;E teams was smooth from mobilization to handover."</p>
                                                </div>
                                                <div class="testimonial-author-content">
                                                    <h3>Nguyen Thanh Hai</h3>
                                                    <p>Project Director, Industrial Investor</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Testimonial Item End -->
                                    </div>
                                    <!-- Testimonial Slide End -->
                                    
                                    <!-- Testimonial Slide Start -->
                                    <div class="swiper-slide">
                                        <!-- Testimonial Item Start -->
                                        <div class="testimonial-item">
                                            <div class="testimonial-company-logo">
                                                <img src="{{ asset('frontend') }}/images/company-logo-2.svg" alt="">
                                            </div> 
                                            <div class="testimonial-item-body">
                                                <div class="testimonial-item-content">
                                                    <p>"Their EPC approach helped us control quality and cost at the same time. Site reporting was clear, and key milestones were met as committed."</p>
                                                </div>
                                                <div class="testimonial-author-content">
                                                    <h3>Tran Minh Duc</h3>
                                                    <p>Operations Manager, Manufacturing Client</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Testimonial Item End -->
                                    </div>
                                    <!-- Testimonial Slide End -->
                                    
                                    <!-- Testimonial Slide Start -->
                                    <div class="swiper-slide">
                                        <!-- Testimonial Item Start -->
                                        <div class="testimonial-item">
                                            <div class="testimonial-company-logo">
                                                <img src="{{ asset('frontend') }}/images/company-logo-3.svg" alt="">
                                            </div> 
                                            <div class="testimonial-item-body">
                                                <div class="testimonial-item-content">
                                                    <p>"From structural steel to utilities and fire protection, Minh Long provided one integrated team. The commissioning phase was professional and efficient."</p>
                                                </div>
                                                <div class="testimonial-author-content">
                                                    <h3>Le Quoc Bao</h3>
                                                    <p>Plant Engineering Head</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Testimonial Item End -->
                                    </div>
                                    <!-- Testimonial Slide End -->
                                </div>
                                <div class="testimonial-pagination"></div>
                            </div>
                        </div>
                        <!-- Testimonial Slider End -->
    
                        <!-- Section Footer Text Start -->
                        <div class="section-footer-text section-footer-contact wow fadeInUp" data-wow-delay="0.2s">   
                            <p><span><img src="{{ asset('frontend') }}/images/icon-phone-primary.svg" alt=""></span> Need a reliable EPC contractor for your factory? <a href="{{ route('site.contact') }}">Talk to Minh Long today</a></p>
                        </div>
                        <!-- Section Footer Text End -->
                    </div>
                    <!-- Testimonial Slider Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Our Testimonial Section End -->

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var btn = document.getElementById('home-about-audio-toggle');
    var audio = document.getElementById('home-about-audio');
    if (!btn || !audio) {
        return;
    }

    function syncUi() {
        var playing = !audio.paused;
        btn.classList.toggle('is-playing', playing);
        btn.setAttribute('aria-pressed', playing ? 'true' : 'false');
    }

    btn.addEventListener('click', function () {
        if (audio.paused) {
            audio.play().catch(function () {});
        } else {
            audio.pause();
        }
    });

    audio.addEventListener('play', syncUi);
    audio.addEventListener('pause', syncUi);
    audio.addEventListener('ended', syncUi);
    syncUi();
});
</script>
@endpush

