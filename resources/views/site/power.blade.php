@extends('layouts.minhlong')

@section('content')
@php
    $phone = $settings['contact_phone'] ?? '088 6656 899';
    $email = $settings['contact_email'] ?? 'info@mlgroup.vn';
@endphp

<div class="hero-silver dark-section parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="hero-content-silver">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Minh Long Power</h3>
                        <h1 class="text-anime-style-3" data-cursor="-opaque">Powering industrial growth with reliable energy solutions</h1>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">We deliver integrated power infrastructure and M&E systems for factories and industrial zones, ensuring safety, reliability, and long-term operational efficiency.</p>
                    </div>
                    <div class="hero-content-body-silver wow fadeInUp" data-wow-delay="0.4s">
                        <div class="hero-body-item-silver"><div class="icon-box"><img src="{{ asset('frontend/images/icon-hero-body-item-1-silver.svg') }}" alt=""></div><div class="hero-body-item-content-silver"><h3>Industrial power infrastructure</h3></div></div>
                        <div class="hero-body-item-silver"><div class="icon-box"><img src="{{ asset('frontend/images/icon-hero-body-item-2-silver.svg') }}" alt=""></div><div class="hero-body-item-content-silver"><h3>M&E systems and commissioning</h3></div></div>
                    </div>
                    <div class="hero-content-footer-silver wow fadeInUp" data-wow-delay="0.6s">
                        <div class="hero-btn"><a href="{{ route('site.contact') }}" class="btn-default btn-highlighted">Get Free Estimate</a></div>
                        <div class="video-play-button"><a href="https://www.youtube.com/watch?v=Y-x0efG1seA" class="popup-video" data-cursor-text="Play"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-play" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg></a><h3>Watch Our Video</h3></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6"><div class="hero-image-silver"><figure><img src="{{ asset('frontend/images/hero-image-silver.png') }}" alt=""></figure></div></div>
        </div>
    </div>
</div>

<div class="about-us-silver"><div class="container"><div class="row"><div class="col-xl-6"><div class="about-us-image-box-silver wow fadeInUp" data-wow-delay="0.2s"><div class="about-image-box-1-silver"><figure class="image-anime"><img src="{{ asset('frontend/images/about-us-image-1-silver.jpg') }}" alt=""></figure></div><div class="about-image-box-2-silver"><figure><img src="{{ asset('frontend/images/about-us-image-2-silver.png') }}" alt=""></figure></div><div class="about-counter-box-silver"><div class="about-counter-silver"><h2><span class="counter">98</span>%</h2><p>Power uptime commitment</p></div></div></div></div><div class="col-xl-6"><div class="about-us-content-silver"><div class="section-title"><h3 class="wow fadeInUp">About Us</h3><h2 class="text-anime-style-3" data-cursor="-opaque">Electrical and M&E partner for industrial projects</h2><p class="wow fadeInUp" data-wow-delay="0.2s">Minh Long Power focuses on medium-voltage distribution, substation integration, factory M&E packages, and reliable commissioning support for investors and operators.</p></div></div></div></div></div></div>

<div class="our-services-silver"><div class="container"><div class="row section-row"><div class="col-lg-12"><div class="section-title section-title-center"><h3 class="wow fadeInUp">Our Services</h3><h2 class="text-anime-style-3" data-cursor="-opaque">Industrial energy and electromechanical capabilities</h2></div></div></div><div class="row"><div class="col-xl-3 col-md-6"><div class="service-item-silver wow fadeInUp"><div class="service-item-header-silver"><div class="icon-box"><img src="{{ asset('frontend/images/icon-service-item-silver-1.svg') }}" alt=""></div><div class="service-item-content-silver"><h3>Substation & distribution</h3><p>Power distribution systems tailored for industrial demand and safe operation.</p></div></div><div class="service-item-image-silver"><figure class="image-anime"><img src="{{ asset('frontend/images/service-image-1-silver.jpg') }}" alt=""></figure></div></div></div><div class="col-xl-3 col-md-6"><div class="service-item-silver wow fadeInUp" data-wow-delay="0.2s"><div class="service-item-header-silver"><div class="icon-box"><img src="{{ asset('frontend/images/icon-service-item-silver-2.svg') }}" alt=""></div><div class="service-item-content-silver"><h3>M&E implementation</h3><p>Mechanical and electrical installation with integrated schedule and QA/QC.</p></div></div><div class="service-item-image-silver"><figure class="image-anime"><img src="{{ asset('frontend/images/service-image-2-silver.jpg') }}" alt=""></figure></div></div></div><div class="col-xl-3 col-md-6"><div class="service-item-silver wow fadeInUp" data-wow-delay="0.4s"><div class="service-item-header-silver"><div class="icon-box"><img src="{{ asset('frontend/images/icon-service-item-silver-3.svg') }}" alt=""></div><div class="service-item-content-silver"><h3>Energy optimization</h3><p>Design and tuning to reduce losses and improve operational efficiency.</p></div></div><div class="service-item-image-silver"><figure class="image-anime"><img src="{{ asset('frontend/images/service-image-3-silver.jpg') }}" alt=""></figure></div></div></div><div class="col-xl-3 col-md-6"><div class="service-item-silver wow fadeInUp" data-wow-delay="0.6s"><div class="service-item-header-silver"><div class="icon-box"><img src="{{ asset('frontend/images/icon-service-item-silver-4.svg') }}" alt=""></div><div class="service-item-content-silver"><h3>Commissioning & handover</h3><p>Testing, commissioning, and documentation for fast go-live.</p></div></div><div class="service-item-image-silver"><figure class="image-anime"><img src="{{ asset('frontend/images/service-image-4-silver.jpg') }}" alt=""></figure></div></div></div></div></div></div>

<div class="what-we-do-silver"><div class="container"><div class="row"><div class="col-xl-5 order-xl-1 order-2"><div class="what-we-do-box-silver wow fadeInUp"><div class="what-we-header-counter-silver"><h2><span class="counter">250</span>+</h2><p>Completed utility and M&E packages</p></div><div class="what-we-body-silver"><div class="what-we-body-image-silver"><figure><img src="{{ asset('frontend/images/what-we-do-image-1-silver.png') }}" alt=""></figure></div></div></div></div><div class="col-xl-7 order-xl-2 order-1"><div class="what-we-do-content-silver"><div class="section-title"><h3 class="wow fadeInUp">WHAT WE DO</h3><h2 class="text-anime-style-3" data-cursor="-opaque">Delivering dependable power and M&E for industrial zones</h2></div><div class="what-we-content-body-silver"><div class="what-we-content-image-silver"><figure class="image-anime reveal"><img src="{{ asset('frontend/images/what-we-do-image-2-silver.jpg') }}" alt=""></figure></div><div class="what-we-items-btn-silver"><div class="what-we-items-list-silver"><div class="what-we-item-silver wow fadeInUp"><div class="icon-box"><img src="{{ asset('frontend/images/icon-what-we-do-item-1-silver.svg') }}" alt=""></div><div class="what-we-item-content-silver"><h3>Engineering excellence</h3><p>Precision design and installation for reliable industrial operations.</p></div></div><div class="what-we-item-silver wow fadeInUp" data-wow-delay="0.2s"><div class="icon-box"><img src="{{ asset('frontend/images/icon-what-we-do-item-2-silver.svg') }}" alt=""></div><div class="what-we-item-content-silver"><h3>Construction & development</h3><p>Disciplined execution aligned with safety and schedule milestones.</p></div></div><div class="what-we-item-silver wow fadeInUp" data-wow-delay="0.4s"><div class="icon-box"><img src="{{ asset('frontend/images/icon-what-we-do-item-3-silver.svg') }}" alt=""></div><div class="what-we-item-content-silver"><h3>Operations-ready delivery</h3><p>Commissioned systems and documentation ready for handover.</p></div></div></div><div class="what-we-do-btn-silver wow fadeInUp" data-wow-delay="0.6s"><a href="{{ route('site.contact') }}" class="btn-default">Contact Us Today</a></div></div></div></div></div></div></div></div>

<div class="our-award-silver dark-section">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="award-title-box-silver">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Award</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Performance and safety recognized across industrial projects</h2>
                    </div>
                    <div class="award-counter-box-silver">
                        <h2><span class="counter">18</span>+</h2>
                        <h3>Recognitions for quality delivery, safety, and commissioning performance.</h3>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="award-item-list-silver">
                    <div class="award-item-silver wow fadeInUp">
                        <div class="icon-box">
                            <img src="{{ asset('frontend/images/icon-award-item-1-silver.svg') }}" alt="">
                        </div>
                        <div class="award-item-content-silver">
                            <h3>Industrial Power Execution Excellence</h3>
                            <ul>
                                <li>Power Infrastructure</li>
                                <li>Quality</li>
                                <li>Reliability</li>
                            </ul>
                        </div>
                    </div>

                    <div class="award-item-silver wow fadeInUp" data-wow-delay="0.2s">
                        <div class="icon-box">
                            <img src="{{ asset('frontend/images/icon-award-item-2-silver.svg') }}" alt="">
                        </div>
                        <div class="award-item-content-silver">
                            <h3>Safety and Compliance Leadership</h3>
                            <ul>
                                <li>HSE</li>
                                <li>Compliance</li>
                                <li>Zero-incident Mindset</li>
                            </ul>
                        </div>
                    </div>

                    <div class="award-item-silver wow fadeInUp" data-wow-delay="0.4s">
                        <div class="icon-box">
                            <img src="{{ asset('frontend/images/icon-award-item-3-silver.svg') }}" alt="">
                        </div>
                        <div class="award-item-content-silver">
                            <h3>M&amp;E Commissioning Performance Award</h3>
                            <ul>
                                <li>Testing</li>
                                <li>Commissioning</li>
                                <li>Operational Readiness</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="our-pricing-silver">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <div class="section-title section-title-center">
                    <h3 class="wow fadeInUp">Delivery Models</h3>
                    <h2 class="text-anime-style-3" data-cursor="-opaque">Flexible collaboration from design to commissioning</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="pricing-item-silver wow fadeInUp">
                    <div class="pricing-item-header-silver">
                        <div class="icon-box">
                            <img src="{{ asset('frontend/images/icon-pricing-1-silver.svg') }}" alt="">
                        </div>
                        <div class="pricing-item-content-silver">
                            <h3>Basic Plan</h3>
                            <p>Entry scope for focused factory utilities and electrical packages.</p>
                        </div>
                    </div>
                    <div class="pricing-item-body-silver">
                        <div class="pricing-item-list-silver">
                            <h2>Phase 1<sub>/Project</sub></h2>
                            <ul>
                                <li>Site power demand assessment</li>
                                <li>Single-line diagram and layout</li>
                                <li>Execution baseline schedule</li>
                                <li>Core QA/QC checklist</li>
                            </ul>
                        </div>
                        <div class="pricing-item-btn-silver">
                            <a href="{{ route('site.contact') }}" class="btn-default">Get Started With Plan</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="pricing-item-silver wow fadeInUp" data-wow-delay="0.2s">
                    <div class="pricing-item-header-silver">
                        <div class="icon-box">
                            <img src="{{ asset('frontend/images/icon-pricing-2-silver.svg') }}" alt="">
                        </div>
                        <div class="pricing-item-content-silver">
                            <h3>Standard Plan</h3>
                            <p>Integrated M&amp;E package for medium-scale industrial facilities.</p>
                        </div>
                    </div>
                    <div class="pricing-item-body-silver">
                        <div class="pricing-item-list-silver">
                            <h2>Phase 2<sub>/Project</sub></h2>
                            <ul>
                                <li>Detailed design and load balancing</li>
                                <li>Installation and supervision</li>
                                <li>Testing and pre-commissioning</li>
                                <li>As-built documentation</li>
                            </ul>
                        </div>
                        <div class="pricing-item-btn-silver">
                            <a href="{{ route('site.contact') }}" class="btn-default">Get Started With Plan</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="pricing-item-silver wow fadeInUp" data-wow-delay="0.4s">
                    <div class="pricing-item-header-silver">
                        <div class="icon-box">
                            <img src="{{ asset('frontend/images/icon-pricing-3-silver.svg') }}" alt="">
                        </div>
                        <div class="pricing-item-content-silver">
                            <h3>Premium Plan</h3>
                            <p>End-to-end power infrastructure delivery for large industrial zones.</p>
                        </div>
                    </div>
                    <div class="pricing-item-body-silver">
                        <div class="pricing-item-list-silver">
                            <h2>Phase 3<sub>/Project</sub></h2>
                            <ul>
                                <li>Substation and distribution implementation</li>
                                <li>Full commissioning and training</li>
                                <li>Safety and compliance audits</li>
                                <li>Operational optimization support</li>
                            </ul>
                        </div>
                        <div class="pricing-item-btn-silver">
                            <a href="{{ route('site.contact') }}" class="btn-default">Get Started With Plan</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="pricing-benefit-list-silver wow fadeInUp" data-wow-delay="0.6s">
                    <ul>
                        <li><img src="{{ asset('frontend/images/icon-pricing-benefit-1.svg') }}" alt="">Transparent scope and milestones</li>
                        <li><img src="{{ asset('frontend/images/icon-pricing-benefit-2.svg') }}" alt="">No hidden execution costs</li>
                        <li><img src="{{ asset('frontend/images/icon-pricing-benefit-3.svg') }}" alt="">Scalable for future expansion</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="our-working-process-silver dark-section">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <div class="section-title section-title-center">
                    <h3 class="wow fadeInUp">Our Working Process</h3>
                    <h2 class="text-anime-style-3" data-cursor="-opaque">Step-by-step delivery from planning to commissioning</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="working-process-item-list-silver wow fadeInUp" data-wow-delay="0.2s">
                    <div class="working-process-item-silver">
                        <div class="working-process-no-silver"><h2>1</h2></div>
                        <div class="working-process-body-silver">
                            <div class="icon-box"><img src="{{ asset('frontend/images/icon-process-item-1-silver.svg') }}" alt=""></div>
                            <div class="working-process-item-content-silver">
                                <h3>Survey &amp; Requirement Analysis</h3>
                                <p>Review demand profile, utility conditions, and compliance requirements at project start.</p>
                            </div>
                        </div>
                    </div>

                    <div class="working-process-item-silver">
                        <div class="working-process-no-silver"><h2>2</h2></div>
                        <div class="working-process-body-silver">
                            <div class="icon-box"><img src="{{ asset('frontend/images/icon-process-item-2-silver.svg') }}" alt=""></div>
                            <div class="working-process-item-content-silver">
                                <h3>Engineering &amp; Design</h3>
                                <p>Prepare detailed technical design, equipment selection, and implementation plan.</p>
                            </div>
                        </div>
                    </div>

                    <div class="working-process-item-silver">
                        <div class="working-process-no-silver"><h2>3</h2></div>
                        <div class="working-process-body-silver">
                            <div class="icon-box"><img src="{{ asset('frontend/images/icon-process-item-3-silver.svg') }}" alt=""></div>
                            <div class="working-process-item-content-silver">
                                <h3>Installation &amp; Integration</h3>
                                <p>Execute on-site installation with strict QA/QC and coordinated M&amp;E integration.</p>
                            </div>
                        </div>
                    </div>

                    <div class="working-process-item-silver">
                        <div class="working-process-no-silver"><h2>4</h2></div>
                        <div class="working-process-body-silver">
                            <div class="icon-box"><img src="{{ asset('frontend/images/icon-process-item-4-silver.svg') }}" alt=""></div>
                            <div class="working-process-item-content-silver">
                                <h3>Testing, Commissioning &amp; Handover</h3>
                                <p>Validate performance, complete documentation, and hand over operation-ready systems.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="our-testimonials-silver"><div class="container"><div class="row"><div class="col-xl-5"><div class="our-testimonial-content-silver"><div class="section-title"><h3 class="wow fadeInUp">Our Testimonials</h3><h2 class="text-anime-style-3" data-cursor="-opaque">Trusted by industrial investors and operators</h2></div></div></div><div class="col-xl-7"><div class="testimonial-slider-box"><div class="section-footer-text section-footer-contact wow fadeInUp" data-wow-delay="0.2s"><p><span><img src="{{ asset('frontend/images/icon-phone-primary.svg') }}" alt=""></span> Need a power infrastructure partner? <a href="tel:{{ preg_replace('/\s+/', '', $phone) }}">{{ $phone }}</a></p></div></div></div></div></div></div>

<div class="our-blog"><div class="container"><div class="row section-row"><div class="col-lg-12"><div class="section-title section-title-center"><h3 class="wow fadeInUp">Latest Blogs</h3><h2 class="text-anime-style-3" data-cursor="-opaque">Industrial power and M&E insights</h2></div></div></div><div class="row"><div class="col-xl-4 col-md-6"><div class="post-item wow fadeInUp"><div class="post-featured-image"><a href="{{ route('site.blog.index') }}" data-cursor-text="View"><figure><img src="{{ asset('frontend/images/post-1.jpg') }}" alt=""></figure></a></div><div class="post-item-body"><div class="post-content-box"><div class="post-item-content"><h2><a href="{{ route('site.blog.index') }}">Grid readiness for new factories</a></h2></div></div></div></div></div><div class="col-xl-4 col-md-6"><div class="post-item wow fadeInUp" data-wow-delay="0.2s"><div class="post-featured-image"><a href="{{ route('site.blog.index') }}" data-cursor-text="View"><figure><img src="{{ asset('frontend/images/post-2.jpg') }}" alt=""></figure></a></div><div class="post-item-body"><div class="post-content-box"><div class="post-item-content"><h2><a href="{{ route('site.blog.index') }}">Commissioning checklist for industrial M&E</a></h2></div></div></div></div></div><div class="col-xl-4 col-md-6"><div class="post-item wow fadeInUp" data-wow-delay="0.4s"><div class="post-featured-image"><a href="{{ route('site.blog.index') }}" data-cursor-text="View"><figure><img src="{{ asset('frontend/images/post-3.jpg') }}" alt=""></figure></a></div><div class="post-item-body"><div class="post-content-box"><div class="post-item-content"><h2><a href="{{ route('site.blog.index') }}">Energy optimization in industrial zones</a></h2></div></div></div></div></div></div></div></div>

@endsection

