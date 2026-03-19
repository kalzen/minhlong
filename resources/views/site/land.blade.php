@extends('layouts.minhlong')

@section('content')

    {{-- Hero Section (clone from index-3 with Minh Long Land content) --}}
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
                                <p>Minh Long Land</p>
                            </div>
                            <!-- Satisfy Client Content End -->
                        </div>
                        <!-- Hero Sub Heading End -->

                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h1 class="text-anime-style-3" data-cursor="-opaque">
                                Investing in industrial parks and strategic infrastructure
                            </h1>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">
                                We focus on heavy investment in industrial parks and large-scale industrial projects,
                                optimizing infrastructure to attract strategic investors and long-term manufacturing tenants.
                            </p>
                        </div>
                        <!-- Section Title End -->

                        <!-- Hero Content Body Start -->
                        <div class="hero-content-body-gold wow fadeInUp" data-wow-delay="0.4s">
                            <!-- Hero Button Start -->
                            <div class="hero-btn-gold">
                                <a href="{{ route('site.contact') }}" class="btn-default btn-highlighted">
                                    Discuss Industrial Land Opportunities
                                </a>
                            </div>
                            <!-- Hero Button End -->

                            <!-- Video Play Button Start -->
                            <div class="video-play-button">
                                <a href="https://www.youtube.com/watch?v=Y-x0efG1seA" class="popup-video" data-cursor-text="Play">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-play" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                    </svg>
                                </a>
                                <h3>Watch Our Industrial Story</h3>
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
                                <img src="{{ asset('frontend') }}/images/hero-image-gold.jpg" alt="Industrial park overview">
                            </figure>
                        </div>
                        <!-- Hero Image End -->

                        <!-- Hero Client Box Start -->
                        <div class="hero-client-box-gold">
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
                            <div class="hero-client-box-content-gold">
                                <p>Preferred industrial partner for strategic investors</p>
                            </div>
                        </div>
                        <!-- Hero Client Box End -->

                        <!-- Hero Video Box Start -->
                        <div class="hero-video-box-gold">
                            <div class="hero-video-image-gold">
                                <figure>
                                    <a href="https://www.youtube.com/watch?v=Y-x0efG1seA" class="popup-video" data-cursor-text="Play">
                                        <img src="{{ asset('frontend') }}/images/hero-video-image-gold.jpg" alt="Industrial park video">
                                    </a>
                                </figure>
                                <div class="video-play-button">
                                    <a href="https://www.youtube.com/watch?v=Y-x0efG1seA" class="popup-video" data-cursor-text="Play">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-play" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="hero-video-content-gold">
                                <h3>Industrial parks and factories ready for lease</h3>
                            </div>
                        </div>
                        <!-- Hero Video Box End -->
                    </div>
                    <!-- Hero Image Box End -->
                </div>
            </div>
        </div>
    </div>

    {{-- About Minh Long Land --}}
    <div class="about-us-gold">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6">
                    <div class="about-us-images-gold wow fadeInUp" data-wow-delay="0.2s">
                        <div class="about-us-image-gold">
                            <figure>
                                <img src="{{ asset('frontend') }}/images/about-us-image-gold.png" alt="Minh Long Land industrial parks">
                            </figure>
                        </div>
                        <div class="about-us-image-title-gold">
                            <h2>Industrial &amp; Land Development</h2>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="about-us-content-gold">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Minh Long Land</h3>
                            <h2 class="text-anime-style-3" data-cursor="-opaque">
                                Real estate development arm of Minh Long Group
                            </h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">
                                Minh Long Land specializes in urban projects, industrial real estate, and social housing.
                                With a sustainable vision, professional expertise, and robust governance processes, we create
                                modern townships, efficient industrial clusters, and safe, affordable housing solutions for communities.
                            </p>
                        </div>

                        <div class="about-us-body-gold wow fadeInUp" data-wow-delay="0.4s">
                            <div class="about-us-hightlighted-content">
                                <h3>“Foundation for sustainable development for communities and investors.”</h3>
                            </div>
                            <div class="about-body-items-list-gold">
                                <div class="about-us-body-item-gold">
                                    <div class="icon-box">
                                        <img src="{{ asset('frontend') }}/images/icon-about-us-body-item-1.svg" alt="">
                                    </div>
                                    <div class="about-us-body-item-content-gold">
                                        <h3>Urban real estate</h3>
                                    </div>
                                </div>
                                <div class="about-us-body-item-gold">
                                    <div class="icon-box">
                                        <img src="{{ asset('frontend') }}/images/icon-about-us-body-item-2.svg" alt="">
                                    </div>
                                    <div class="about-us-body-item-content-gold">
                                        <h3>Industrial real estate</h3>
                                    </div>
                                </div>
                                <div class="about-us-body-item-gold">
                                    <div class="icon-box">
                                        <img src="{{ asset('frontend') }}/images/icon-about-us-body-item-3.svg" alt="">
                                    </div>
                                    <div class="about-us-body-item-content-gold">
                                        <h3>Social housing</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="about-us-footer-gold wow fadeInUp" data-wow-delay="0.6s">
                            <div class="about-us-counter-box-gold">
                                <h2><span class="counter">3</span>+</h2>
                                <p>Core real estate segments</p>
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
                        <h3 class="wow fadeInUp">Our Services</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">
                            Core real estate portfolio across urban, industrial and social housing
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
                                    Residential communities, commercial apartments, hotels and mixed-use urban buildings
                                    in well-planned townships.
                                </p>
                            </div>
                        </div>
                        <div class="service-item-body-gold">
                            <div class="service-item-title-gold">
                                <h2>Urban real estate</h2>
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
                                    Industrial parks, industrial clusters, warehouses and factories for lease with optimized
                                    infrastructure for manufacturing tenants.
                                </p>
                            </div>
                        </div>
                        <div class="service-item-body-gold">
                            <div class="service-item-title-gold">
                                <h2>Industrial real estate</h2>
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
                                    Low-rise and high-rise social housing projects that provide safe, affordable homes for
                                    workers and local communities.
                                </p>
                            </div>
                        </div>
                        <div class="service-item-body-gold">
                            <div class="service-item-title-gold">
                                <h2>Social housing</h2>
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
                        <h3 class="wow fadeInUp">What We Do</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">
                            Focused investment in industrial parks, large-scale industrial projects and strategic infrastructure
                        </h2>
                    </div>
                </div>
            </div>

            <div class="row align-items-end">
                <div class="col-xl-3 col-md-6">
                    <div class="what-we-item-gold box-1 wow fadeInUp">
                        <div class="what-we-item-header-gold">
                            <div class="what-we-item-title-gold">
                                <h3>Developing strategic industrial zones</h3>
                            </div>
                            <div class="icon-box">
                                <img src="{{ asset('frontend') }}/images/icon-what-we-item-1-gold.svg" alt="">
                            </div>
                        </div>
                        <div class="what-we-item-image-gold">
                            <figure class="image-anime">
                                <img src="{{ asset('frontend') }}/images/what-we-item-image-1-gold.jpg" alt="">
                            </figure>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="what-we-item-gold box-2 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="what-we-item-header-gold">
                            <div class="what-we-item-shape-image-gold">
                                <figure>
                                    <img src="{{ asset('frontend') }}/images/what-we-item-shape-image-1-gold.jpg" alt="">
                                </figure>
                            </div>
                            <div class="what-we-item-btn-gold">
                                <a href="{{ route('site.contact') }}"><img src="{{ asset('frontend') }}/images/arrow-accent.svg" alt=""></a>
                            </div>
                        </div>
                        <div class="what-we-item-title-gold">
                            <h3>Optimizing infrastructure to attract strategic investors</h3>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="what-we-counter-box-gold box-3 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="what-we-item-image-gold">
                            <figure class="image-anime">
                                <img src="{{ asset('frontend') }}/images/what-we-item-image-2-gold.jpg" alt="">
                            </figure>
                        </div>
                        <div class="what-we-counter-item-gold">
                            <h2><span class="counter">3</span></h2>
                            <p>Flagship industrial and social housing projects</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="what-we-item-gold box-4 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="what-we-item-shape-image-gold">
                            <figure>
                                <img src="{{ asset('frontend') }}/images/what-we-item-shape-image-2-gold.jpg" alt="">
                            </figure>
                        </div>
                        <div class="what-we-item-title-gold">
                            <h3>Delivering integrated land and infrastructure solutions for strategic tenants</h3>
                        </div>
                        <div class="what-we-item-body-gold">
                            <div class="learn-more-circle-gold">
                                <a href="{{ route('site.contact') }}"><img src="{{ asset('frontend') }}/images/learn-more-circle.svg" alt=""></a>
                            </div>
                            <div class="what-we-item-body-image-gold">
                                <img src="{{ asset('frontend') }}/images/what-we-item-body-image-gold.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="what-we-contect-list-gold wow fadeInUp" data-wow-delay="0.4s">
                        <h3>Contact us today!</h3>
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
                        <h3 class="wow fadeInUp">Latest Projects</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Explore our most recent complete project portfolio</h2>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-4">
                    <div class="section-btn wow fadeInUp" data-wow-delay="0.2s">
                        <a href="{{ route('site.contact') }}" class="btn-default">View All Project</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="project-item-gold wow fadeInUp">
                        <div class="project-item-image-box-gold">
                            <div class="project-item-image-gold">
                                <a href="{{ route('site.contact') }}" data-cursor-text="View">
                                    <figure class="image-anime">
                                        <img src="{{ asset('frontend') }}/images/project-image-1-gold.jpg" alt="LHP Social Housing Project – Hai Phong">
                                    </figure>
                                </a>
                            </div>

                            <div class="project-item-tag-gold">
                                <a href="{{ route('site.contact') }}">Social housing</a>
                            </div>
                        </div>

                        <div class="project-item-body-gold">
                            <div class="project-item-content-gold">
                                <h2><a href="{{ route('site.contact') }}">LHP Social Housing Project – Hai Phong</a></h2>
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
                                <a href="{{ route('site.contact') }}" data-cursor-text="View">
                                    <figure class="image-anime">
                                        <img src="{{ asset('frontend') }}/images/project-image-2-gold.jpg" alt="Ban Thien Industrial Cluster and factory complex for lease">
                                    </figure>
                                </a>
                            </div>

                            <div class="project-item-tag-gold">
                                <a href="{{ route('site.contact') }}">Industrial cluster</a>
                            </div>
                        </div>

                        <div class="project-item-body-gold">
                            <div class="project-item-content-gold">
                                <h2><a href="{{ route('site.contact') }}">Ban Thien Industrial Cluster &amp; factory complex for lease</a></h2>
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
                                    <img src="{{ asset('frontend') }}/images/why-choose-item-image-gold.jpg" alt="">
                                </figure>
                            </div>
                            <div class="why-choose-item-body-gold">
                                <div class="why-choose-item-btn-gold">
                                    <a href="{{ route('site.contact') }}"><img src="{{ asset('frontend') }}/images/arrow-white.svg" alt=""></a>
                                </div>
                                <div class="why-choose-item-content-gold">
                                    <h3>Investor-oriented infrastructure delivery</h3>
                                    <p>From internal roads to utilities, we optimize infrastructure for fast tenant onboarding.</p>
                                </div>
                            </div>
                        </div>
                        <div class="why-choose-counter-list-gold wow fadeInUp">
                            <div class="why-choose-counter-item-gold"><h2><span class="counter">3</span>+</h2><p>Flagship projects</p></div>
                            <div class="why-choose-counter-item-gold"><h2><span class="counter">30</span>+</h2><p>Industrial zone network</p></div>
                            <div class="why-choose-counter-item-gold"><h2><span class="counter">120</span>+</h2><p>Strategic partners</p></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 order-xl-2 order-1">
                    <div class="why-choose-us-content-gold">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Why Choose Us</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Land development with industrial execution discipline</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">Minh Long Land combines planning, legal-readiness mindset, and implementation control to build high-quality industrial assets for long-term investors.</p>
                        </div>
                        <div class="why-choose-body-gold wow fadeInUp" data-wow-delay="0.4s">
                            <div class="why-choose-body-item-gold">
                                <div class="icon-box"><img src="{{ asset('frontend') }}/images/icon-why-choose-body-item-1-gold.svg" alt=""></div>
                                <div class="why-choose-body-item-content-gold">
                                    <h2>Risk-controlled project governance</h2>
                                    <p>Strict schedule, quality, and safety controls from planning through handover.</p>
                                </div>
                            </div>
                        </div>
                        <div class="why-choose-us-btn-gold wow fadeInUp" data-wow-delay="0.6s">
                            <a href="{{ route('site.contact') }}" class="btn-default btn-highlighted">contact us</a>
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
                        <h3 class="wow fadeInUp">core Feature</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Core strengths of Minh Long Land</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-md-6"><div class="feature-item-gold wow fadeInUp"><div class="feature-item-content-gold"><h3>Urban planning</h3><p>Integrated planning for modern townships and community services.</p></div><div class="feature-item-image-gold"><figure><img src="{{ asset('frontend') }}/images/feature-item-image-1-gold.png" alt=""></figure></div></div></div>
                <div class="col-xl-3 col-md-6"><div class="feature-item-gold wow fadeInUp" data-wow-delay="0.2s"><div class="feature-item-content-gold"><h3>Industrial park strategy</h3><p>Land-use and utility optimization for manufacturing and logistics tenants.</p></div><div class="feature-item-image-gold"><figure><img src="{{ asset('frontend') }}/images/feature-item-image-2-gold.png" alt=""></figure></div></div></div>
                <div class="col-xl-3 col-md-6"><div class="feature-item-gold wow fadeInUp" data-wow-delay="0.4s"><div class="feature-item-content-gold"><h3>Leasable factory assets</h3><p>Warehouses and factory complexes built for scalable operations.</p></div><div class="feature-item-image-gold"><figure><img src="{{ asset('frontend') }}/images/feature-item-image-3-gold.png" alt=""></figure></div></div></div>
                <div class="col-xl-3 col-md-6"><div class="feature-item-gold wow fadeInUp" data-wow-delay="0.6s"><div class="feature-item-content-gold"><h3>Social housing programs</h3><p>Safe and affordable homes for workers and local communities.</p></div><div class="feature-item-image-gold"><figure><img src="{{ asset('frontend') }}/images/feature-item-image-4-gold.png" alt=""></figure></div></div></div>
            </div>
        </div>
    </div>

    {{-- CTA --}}
    <div class="cta-box-gold">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="cta-box-image-gold"><figure><img src="{{ asset('frontend') }}/images/cta-box-image-gold.png" alt=""></figure></div>
                </div>
                <div class="col-lg-6">
                    <div class="cta-box-content-gold">
                        <div class="section-title section-title-center">
                            <h3 class="wow fadeInUp">join us today</h3>
                            <h2 class="text-anime-style-3" data-cursor="-opaque">Partner with Minh Long Land for long-term industrial growth</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">Tell us your investment criteria and preferred locations. We will align land, infrastructure, and project model to your growth strategy.</p>
                        </div>
                        <div class="cta-box-list-gold wow fadeInUp" data-wow-delay="0.4s">
                            <ul>
                                <li>Industrial-ready land planning and utilities</li>
                                <li>Execution mindset focused on investor returns</li>
                            </ul>
                        </div>
                        <div class="cta-box-btn-gold wow fadeInUp" data-wow-delay="0.6s">
                            <a href="{{ route('site.contact') }}" class="btn-default">Get Started Today</a>
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
                                <h3 class="wow fadeInUp">Watch Video</h3>
                                <h2 class="text-anime-style-3" data-cursor="-opaque">See how we develop strategic industrial assets</h2>
                                <p class="wow fadeInUp" data-wow-delay="0.2s">From land planning to infrastructure readiness and handover, Minh Long Land builds project platforms that attract high-quality investors.</p>
                            </div>
                            <div class="intro-video-button-gold">
                                <a href="https://www.youtube.com/watch?v=Y-x0efG1seA" class="popup-video" data-cursor-text="Play"><img src="{{ asset('frontend') }}/images/intero-video-circle.svg" alt=""></a>
                            </div>
                        </div>
                        <div class="intro-video-counter-box-gold">
                            <div class="intro-video-counter-item-gold"><h2><span class="counter">3</span>+</h2><p>Flagship projects</p></div>
                            <div class="intro-video-counter-item-gold"><h2><span class="counter">30</span>+</h2><p>Industrial zones</p></div>
                            <div class="intro-video-counter-item-gold"><h2><span class="counter">120</span>+</h2><p>Partners</p></div>
                            <div class="intro-video-counter-item-gold"><h2><span class="counter">98</span>%</h2><p>Schedule commitment</p></div>
                            <div class="intro-video-counter-item-gold"><h2><span class="counter">15</span>+</h2><p>Years combined expertise</p></div>
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
                        <h3 class="wow fadeInUp">Development Models</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Flexible investment and development collaboration options</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-md-6"><div class="pricing-item-gold wow fadeInUp"><div class="pricing-item-header-gold"><div class="pricing-item-content-gold"><h3>Land reserve model</h3><h2>Phase 1<sub> /Entry</sub></h2><p>Site screening, legal baseline and land preparation roadmap.</p></div><div class="pricing-item-btn-gold"><a href="{{ route('site.contact') }}" class="btn-default">Get Started</a></div></div></div></div>
                <div class="col-xl-4 col-md-6"><div class="pricing-item-gold wow fadeInUp" data-wow-delay="0.2s"><div class="pricing-item-header-gold"><div class="pricing-item-content-gold"><h3>Infrastructure co-development</h3><h2>Phase 2<sub> /Scale</sub></h2><p>Roads, utilities and industrial platform optimization.</p></div><div class="pricing-item-btn-gold"><a href="{{ route('site.contact') }}" class="btn-default">Get Started</a></div></div></div></div>
                <div class="col-xl-4 col-md-6"><div class="pricing-item-gold wow fadeInUp" data-wow-delay="0.4s"><div class="pricing-item-header-gold"><div class="pricing-item-content-gold"><h3>Leasable asset expansion</h3><h2>Phase 3<sub> /Operate</sub></h2><p>Factory complexes and leasing-focused operations support.</p></div><div class="pricing-item-btn-gold"><a href="{{ route('site.contact') }}" class="btn-default">Get Started</a></div></div></div></div>
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
                            <h3 class="wow fadeInUp">Our Testimonials</h3>
                            <h2 class="text-anime-style-3" data-cursor="-opaque">Real feedback from investors and industrial partners</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">We take pride in long-term partnerships. Here is how Minh Long Land supports site selection, infrastructure readiness, and project execution for strategic investors.</p>
                        </div>
                        <div class="testimonial-btn-gold wow fadeInUp" data-wow-delay="0.4s">
                            <a href="{{ route('site.contact') }}" class="btn-default">View All Reviews</a>
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
                                    <p>"Minh Long Land helped us secure an industrial location with infrastructure-readiness and a clear development roadmap. The team was transparent and responsive from planning to launch."</p>
                                </div>
                            </div>
                            <div class="testimonial-item-body-gold">
                                <div class="testimonial-author-gold">
                                    <div class="author-image-gold">
                                        <figure class="image-anime">
                                            <img src="{{ asset('frontend') }}/images/author-1.jpg" alt="">
                                        </figure>
                                    </div>
                                    <div class="author-content-gold">
                                        <h3>Dominick Parker</h3>
                                        <p>Investment Director</p>
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
                                    <p>"What impressed us most was governance discipline: milestone clarity, schedule control, and practical infrastructure solutions aligned with our expansion strategy."</p>
                                </div>
                            </div>
                            <div class="testimonial-item-body-gold">
                                <div class="testimonial-author-gold">
                                    <div class="author-image-gold">
                                        <figure class="image-anime">
                                            <img src="{{ asset('frontend') }}/images/author-2.jpg" alt="">
                                        </figure>
                                    </div>
                                    <div class="author-content-gold">
                                        <h3>Devon Lane</h3>
                                        <p>Operations Partner</p>
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
                        <h3 class="wow fadeInUp">Latest Blogs</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Industrial real estate insights and project updates</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-md-6"><div class="post-item wow fadeInUp"><div class="post-featured-image"><a href="{{ route('site.blog.index') }}" data-cursor-text="View"><figure><img src="{{ asset('frontend') }}/images/post-1.jpg" alt=""></figure></a></div><div class="post-item-body"><div class="post-content-box"><div class="post-item-content"><h2><a href="{{ route('site.blog.index') }}">Industrial park readiness: utilities and access planning</a></h2></div></div></div></div></div>
                <div class="col-xl-4 col-md-6"><div class="post-item wow fadeInUp" data-wow-delay="0.2s"><div class="post-featured-image"><a href="{{ route('site.blog.index') }}" data-cursor-text="View"><figure><img src="{{ asset('frontend') }}/images/post-2.jpg" alt=""></figure></a></div><div class="post-item-body"><div class="post-content-box"><div class="post-item-content"><h2><a href="{{ route('site.blog.index') }}">How strategic investors evaluate industrial locations</a></h2></div></div></div></div></div>
                <div class="col-xl-4 col-md-6"><div class="post-item wow fadeInUp" data-wow-delay="0.4s"><div class="post-featured-image"><a href="{{ route('site.blog.index') }}" data-cursor-text="View"><figure><img src="{{ asset('frontend') }}/images/post-3.jpg" alt=""></figure></a></div><div class="post-item-body"><div class="post-content-box"><div class="post-item-content"><h2><a href="{{ route('site.blog.index') }}">Social housing and industrial growth: integrated development</a></h2></div></div></div></div></div>
            </div>
        </div>
    </div>

@endsection

