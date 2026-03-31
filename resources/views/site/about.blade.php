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
                                <img src="{{ asset('frontend') }}/images/about-us-image-1.jpg" alt="Minh Long industrial construction">
                            </figure>
                        </div>
                    </div>
                    <div class="about-us-image-box-2">
                        <div class="about-us-image">
                            <figure class="image-anime">
                                <img src="{{ asset('frontend') }}/images/about-us-image-2.jpg" alt="Minh Long EPC site">
                            </figure>
                        </div>
                        <div class="year-experience-circle">
                            <img src="{{ asset('frontend') }}/images/year-experience-circle-accent.svg" alt="">
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
                                <img src="{{ asset('frontend') }}/images/icon-about-item-1.svg" alt="">
                            </div>
                            <div class="about-body-item-content">
                                <h3>EPC turnkey delivery</h3>
                                <p>Integrated scope from civil works, steel structure, and finishing to M&amp;E and fire protection (PCCC).</p>
                            </div>
                        </div>
                        <div class="about-body-item">
                            <div class="icon-box">
                                <img src="{{ asset('frontend') }}/images/icon-about-item-2.svg" alt="">
                            </div>
                            <div class="about-body-item-content">
                                <h3>Industrial-zone expertise</h3>
                                <p>Experience delivering factories and logistics facilities in major industrial zones across Viet Nam.</p>
                            </div>
                        </div>
                    </div>

                    <div class="about-us-footer wow fadeInUp" data-wow-delay="0.6s">
                        <div class="about-us-footer-content">
                            <div class="about-footer-content-list">
                                <ul>
                                    <li>Single-point accountability for schedule, quality, and safety.</li>
                                    <li>Lean construction approach to optimize total investment cost.</li>
                                    <li>Long-term partnership mindset with industrial investors.</li>
                                </ul>
                            </div>
                            <div class="about-us-btn">
                                <a href="{{ route('site.contact') }}" class="btn-default">Discuss Your Project</a>
                            </div>
                        </div>
                        <div class="about-us-video-box">
                            <div class="about-video-image">
                                <figure class="image-anime">
                                    <img src="{{ asset('frontend') }}/images/about-intro-video-image.jpg" alt="Minh Long project highlight">
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

{{-- EPC Capabilities --}}
<div class="our-approach dark-section parallaxie">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <div class="section-title section-title-center">
                    <h3 class="wow fadeInUp">Our EPC capabilities</h3>
                    <h2 class="text-anime-style-3" data-cursor="-opaque">From concept to commissioning for factory projects</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="approach-item box-1 wow fadeInUp">
                    <div class="icon-box">
                        <img src="{{ asset('frontend') }}/images/approach-item-bg-1.svg" alt="">
                    </div>
                    <div class="approach-item-image">
                        <figure>
                            <img src="{{ asset('frontend') }}/images/approach-item-image-1.jpg" alt="">
                        </figure>
                    </div>
                    <div class="approach-item-content">
                        <h3>Design &amp; consulting</h3>
                        <p>Consulting and design services for civil, industrial, and infrastructure packages in factories.</p>
                        <ul>
                            <li>Master planning and layout optimization.</li>
                            <li>Coordination with utilities and industrial zone requirements.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="approach-item box-2 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="icon-box">
                        <img src="{{ asset('frontend') }}/images/approach-item-bg-2.svg" alt="">
                    </div>
                    <div class="approach-item-image">
                        <figure>
                            <img src="{{ asset('frontend') }}/images/approach-item-image-2.jpg" alt="">
                        </figure>
                    </div>
                    <div class="approach-item-content">
                        <h3>Construction &amp; installation</h3>
                        <p>Civil works, steel structure, finishing, and M&amp;E installation under one integrated schedule.</p>
                        <ul>
                            <li>HSE management and on-site supervision.</li>
                            <li>Progress tracking and transparent reporting.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="approach-item box-3 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="icon-box">
                        <img src="{{ asset('frontend') }}/images/approach-item-bg-3.svg" alt="">
                    </div>
                    <div class="approach-item-image">
                        <figure>
                            <img src="{{ asset('frontend') }}/images/approach-item-image-3.jpg" alt="">
                        </figure>
                    </div>
                    <div class="approach-item-content">
                        <h3>QA/QC &amp; commissioning</h3>
                        <p>Structured QA/QC for steel, coatings, M&amp;E, and fire protection to meet investor and regulatory standards.</p>
                        <ul>
                            <li>Testing, commissioning, and documentation.</li>
                            <li>Support for handover and operation readiness.</li>
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
                    <h3 class="wow fadeInUp">Key metrics</h3>
                    <h2 class="text-anime-style-3" data-cursor="-opaque">Industrial projects delivered with EPC precision</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="feature-item box-1 wow fadeInUp">
                    <div class="feature-item-content-box">
                        <div class="feature-item-content">
                            <h2><span class="counter">120</span>+</h2>
                            <h3>Industrial partners</h3>
                        </div>
                        <div class="feature-item-counter-info">
                            <p>Investors and manufacturers trusting Minh Long for factory and logistics facilities.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="feature-item box-2 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="feature-item-content-box">
                        <div class="feature-item-content">
                            <h2><span class="counter">30</span>+</h2>
                            <h3>Industrial zones</h3>
                        </div>
                        <div class="feature-item-counter-info">
                            <p>Projects delivered in key industrial zones across Viet Nam.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="feature-item box-3 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="feature-item-content-box">
                        <div class="feature-item-content">
                            <h2><span class="counter">300</span>+</h2>
                            <h3>Engineers &amp; experts</h3>
                        </div>
                        <div class="feature-item-counter-info">
                            <p>Technical teams focused on schedule, quality, and safety in every project.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
