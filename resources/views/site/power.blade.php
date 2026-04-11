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
                        <h3 class="wow fadeInUp">{{ __('site.power.hero.brand') }}</h3>
                        <h1 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.power.hero.title') }}</h1>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">{{ __('site.power.hero.description') }}</p>
                    </div>
                    <div class="hero-content-body-silver wow fadeInUp" data-wow-delay="0.4s">
                        <div class="hero-body-item-silver"><div class="icon-box"><img src="{{ asset('frontend/images/icon-hero-body-item-1-silver.svg') }}" alt=""></div><div class="hero-body-item-content-silver"><h3>{{ __('site.power.hero.item1_title') }}</h3></div></div>
                        <div class="hero-body-item-silver"><div class="icon-box"><img src="{{ asset('frontend/images/icon-hero-body-item-2-silver.svg') }}" alt=""></div><div class="hero-body-item-content-silver"><h3>{{ __('site.power.hero.item2_title') }}</h3></div></div>
                    </div>
                    <div class="hero-content-footer-silver wow fadeInUp" data-wow-delay="0.6s">
                        <div class="hero-btn"><a href="{{ route('site.contact') }}" class="btn-default btn-highlighted">{{ __('site.power.hero.cta') }}</a></div>
                        <div class="video-play-button"><a href="https://www.youtube.com/watch?v=hDwNapdDdQA" class="popup-video" data-cursor-text="{{ __('site.common.play') }}"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-play" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg></a><h3>{{ __('site.power.hero.video') }}</h3></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="hero-image-silver">
                    <figure>
                        <img src="{{ \App\Support\SiteMedia::urlOrDefault('sector.power.hero') }}" alt="{{ __('site.power.hero.brand') }} — {{ __('site.power.hero.title') }}">
                    </figure>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="about-us-silver">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="about-us-image-box-silver wow fadeInUp" data-wow-delay="0.2s">
                    <div class="about-image-box-1-silver">
                        <figure class="image-anime">
                            <img src="{{ asset('frontend/images/power-4.jpg') }}" alt="{{ __('site.power.about.title') }}">
                        </figure>
                    </div>
                    <div class="about-image-box-2-silver">
                        <figure>
                            <img src="{{ asset('frontend/images/about-us-image-2-silver.png') }}" alt="{{ __('site.power.about.headline') }}">
                        </figure>
                    </div>
                    <div class="about-counter-box-silver">
                        <div class="about-counter-silver">
                            <h2><span class="counter">98</span>%</h2>
                            <p>{{ __('site.power.about.counter') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="about-us-content-silver">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">{{ __('site.power.about.title') }}</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.power.about.headline') }}</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">{{ __('site.power.about.description') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="our-services-silver">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <div class="section-title section-title-center">
                    <h3 class="wow fadeInUp">{{ __('site.power.services.title') }}</h3>
                    <h2 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.power.services.subtitle') }}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @php
                $powerServiceImages = [
                    'frontend/images/minhlong-power.jpg',
                    'frontend/images/power-1.jpg',
                    'frontend/images/power-2.JPG',
                    'frontend/images/power-4.jpg',
                ];
            @endphp
            @foreach (range(1, 4) as $i)
                <div class="col-xl-3 col-md-6">
                    <div class="service-item-silver wow fadeInUp" @if($i > 1) data-wow-delay="{{ (string) (($i - 1) * 0.2) }}s" @endif>
                        <div class="service-item-header-silver">
                            <div class="icon-box">
                                <img src="{{ asset('frontend/images/icon-service-item-silver-'.$i.'.svg') }}" alt="">
                            </div>
                            <div class="service-item-content-silver">
                                <h3>{{ __('site.power.services.item'.$i.'_title') }}</h3>
                                <p>{{ __('site.power.services.item'.$i.'_desc') }}</p>
                            </div>
                        </div>
                        <div class="service-item-image-silver">
                            <figure class="image-anime">
                                <img
                                    src="{{ asset($powerServiceImages[$i - 1]) }}"
                                    alt="{{ __('site.power.services.item'.$i.'_title') }}"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </figure>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="what-we-do-silver">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 order-xl-1 order-2">
                <div class="what-we-do-box-silver wow fadeInUp">
                    <div class="what-we-box-header-silver">
                        <div class="what-we-header-counter-silver">
                            <h2><span class="counter">250</span>+</h2>
                            <p>{{ __('site.power.what_we_do.counter') }}</p>
                        </div>
                        <div class="what-we-counter-info-silver">
                            <p>{{ __('site.power.what_we_do.counter_info') }}</p>
                        </div>
                    </div>
                    <div class="what-we-body-silver">
                        <div class="what-we-body-image-silver">
                            <figure>
                                <img src="{{ asset('frontend/images/power-1.jpg') }}" alt="{{ __('site.power.what_we_do.counter') }}">
                            </figure>
                        </div>
                        <div class="what-we-counter-box-silver">
                            <div class="what-we-counter-box-title-silver">
                                <h3>{{ __('site.power.what_we_do.numbers_title') }}</h3>
                            </div>
                            <div class="what-we-counter-list-silver">
                                <div class="what-we-counter-item-silver">
                                    <h2><span class="counter">15</span>+</h2>
                                    <p>{{ __('site.power.what_we_do.stat1_label') }}</p>
                                </div>
                                <div class="what-we-counter-item-silver">
                                    <h2><span class="counter">50</span>+</h2>
                                    <p>{{ __('site.power.what_we_do.stat2_label') }}</p>
                                </div>
                                <div class="what-we-counter-item-silver">
                                    <h2><span class="counter">120</span>+</h2>
                                    <p>{{ __('site.power.what_we_do.stat3_label') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-7 order-xl-2 order-1">
                <div class="what-we-do-content-silver">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">{{ __('site.power.what_we_do.eyebrow') }}</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.power.what_we_do.title') }}</h2>
                    </div>
                    <div class="what-we-content-body-silver">
                        <div class="what-we-content-image-silver">
                            <figure class="image-anime reveal">
                                <img src="{{ asset('frontend/images/power-2.JPG') }}" alt="{{ __('site.power.what_we_do.title') }}">
                            </figure>
                        </div>
                        <div class="what-we-items-btn-silver">
                            <div class="what-we-items-list-silver">
                                <div class="what-we-item-silver wow fadeInUp">
                                    <div class="icon-box">
                                        <img src="{{ asset('frontend/images/icon-what-we-do-item-1-silver.svg') }}" alt="">
                                    </div>
                                    <div class="what-we-item-content-silver">
                                        <h3>{{ __('site.power.what_we_do.item1_title') }}</h3>
                                        <p>{{ __('site.power.what_we_do.item1_desc') }}</p>
                                    </div>
                                </div>
                                <div class="what-we-item-silver wow fadeInUp" data-wow-delay="0.2s">
                                    <div class="icon-box">
                                        <img src="{{ asset('frontend/images/icon-what-we-do-item-2-silver.svg') }}" alt="">
                                    </div>
                                    <div class="what-we-item-content-silver">
                                        <h3>{{ __('site.power.what_we_do.item2_title') }}</h3>
                                        <p>{{ __('site.power.what_we_do.item2_desc') }}</p>
                                    </div>
                                </div>
                                <div class="what-we-item-silver wow fadeInUp" data-wow-delay="0.4s">
                                    <div class="icon-box">
                                        <img src="{{ asset('frontend/images/icon-what-we-do-item-3-silver.svg') }}" alt="">
                                    </div>
                                    <div class="what-we-item-content-silver">
                                        <h3>{{ __('site.power.what_we_do.item3_title') }}</h3>
                                        <p>{{ __('site.power.what_we_do.item3_desc') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="what-we-do-btn-silver wow fadeInUp" data-wow-delay="0.6s">
                                <a href="{{ route('site.contact') }}" class="btn-default">{{ __('site.power.what_we_do.cta') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="our-award-silver dark-section">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="award-title-box-silver">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">{{ __('site.power.award.title') }}</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.power.award.headline') }}</h2>
                    </div>
                    <div class="award-counter-box-silver">
                        <h2><span class="counter">18</span>+</h2>
                        <h3>{{ __('site.power.award.recognitions') }}</h3>
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
                            <h3>{{ __('site.power.award.item1_title') }}</h3>
                            <ul>
                                <li>{{ __('site.power.award.item1_li1') }}</li>
                                <li>{{ __('site.power.award.item1_li2') }}</li>
                                <li>{{ __('site.power.award.item1_li3') }}</li>
                            </ul>
                        </div>
                    </div>

                    <div class="award-item-silver wow fadeInUp" data-wow-delay="0.2s">
                        <div class="icon-box">
                            <img src="{{ asset('frontend/images/icon-award-item-2-silver.svg') }}" alt="">
                        </div>
                        <div class="award-item-content-silver">
                            <h3>{{ __('site.power.award.item2_title') }}</h3>
                            <ul>
                                <li>{{ __('site.power.award.item2_li1') }}</li>
                                <li>{{ __('site.power.award.item2_li2') }}</li>
                                <li>{{ __('site.power.award.item2_li3') }}</li>
                            </ul>
                        </div>
                    </div>

                    <div class="award-item-silver wow fadeInUp" data-wow-delay="0.4s">
                        <div class="icon-box">
                            <img src="{{ asset('frontend/images/icon-award-item-3-silver.svg') }}" alt="">
                        </div>
                        <div class="award-item-content-silver">
                            <h3>{{ __('site.power.award.item3_title') }}</h3>
                            <ul>
                                <li>{{ __('site.power.award.item3_li1') }}</li>
                                <li>{{ __('site.power.award.item3_li2') }}</li>
                                <li>{{ __('site.power.award.item3_li3') }}</li>
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
                    <h3 class="wow fadeInUp">{{ __('site.power.delivery_models.title') }}</h3>
                    <h2 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.power.delivery_models.subtitle') }}</h2>
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
                            <h3>{{ __('site.power.delivery_models.plan1_title') }}</h3>
                            <p>{{ __('site.power.delivery_models.plan1_desc') }}</p>
                        </div>
                    </div>
                    <div class="pricing-item-body-silver">
                        <div class="pricing-item-list-silver">
                            <h2>{{ __('site.power.delivery_models.plan1_phase') }}<sub>/{{ __('site.power.delivery_models.project_sub') }}</sub></h2>
                            <ul>
                                <li>{{ __('site.power.delivery_models.plan1_li1') }}</li>
                                <li>{{ __('site.power.delivery_models.plan1_li2') }}</li>
                                <li>{{ __('site.power.delivery_models.plan1_li3') }}</li>
                                <li>{{ __('site.power.delivery_models.plan1_li4') }}</li>
                            </ul>
                        </div>
                        <div class="pricing-item-btn-silver">
                            <a href="{{ route('site.contact') }}" class="btn-default">{{ __('site.power.delivery_models.plan_button') }}</a>
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
                            <h3>{{ __('site.power.delivery_models.plan2_title') }}</h3>
                            <p>{{ __('site.power.delivery_models.plan2_desc') }}</p>
                        </div>
                    </div>
                    <div class="pricing-item-body-silver">
                        <div class="pricing-item-list-silver">
                            <h2>{{ __('site.power.delivery_models.plan2_phase') }}<sub>/{{ __('site.power.delivery_models.project_sub') }}</sub></h2>
                            <ul>
                                <li>{{ __('site.power.delivery_models.plan2_li1') }}</li>
                                <li>{{ __('site.power.delivery_models.plan2_li2') }}</li>
                                <li>{{ __('site.power.delivery_models.plan2_li3') }}</li>
                                <li>{{ __('site.power.delivery_models.plan2_li4') }}</li>
                            </ul>
                        </div>
                        <div class="pricing-item-btn-silver">
                            <a href="{{ route('site.contact') }}" class="btn-default">{{ __('site.power.delivery_models.plan_button') }}</a>
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
                            <h3>{{ __('site.power.delivery_models.plan3_title') }}</h3>
                            <p>{{ __('site.power.delivery_models.plan3_desc') }}</p>
                        </div>
                    </div>
                    <div class="pricing-item-body-silver">
                        <div class="pricing-item-list-silver">
                            <h2>{{ __('site.power.delivery_models.plan3_phase') }}<sub>/{{ __('site.power.delivery_models.project_sub') }}</sub></h2>
                            <ul>
                                <li>{{ __('site.power.delivery_models.plan3_li1') }}</li>
                                <li>{{ __('site.power.delivery_models.plan3_li2') }}</li>
                                <li>{{ __('site.power.delivery_models.plan3_li3') }}</li>
                                <li>{{ __('site.power.delivery_models.plan3_li4') }}</li>
                            </ul>
                        </div>
                        <div class="pricing-item-btn-silver">
                            <a href="{{ route('site.contact') }}" class="btn-default">{{ __('site.power.delivery_models.plan_button') }}</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="pricing-benefit-list-silver wow fadeInUp" data-wow-delay="0.6s">
                    <ul>
                        <li><img src="{{ asset('frontend/images/icon-pricing-benefit-1.svg') }}" alt="">{{ __('site.power.delivery_models.benefit1') }}</li>
                        <li><img src="{{ asset('frontend/images/icon-pricing-benefit-2.svg') }}" alt="">{{ __('site.power.delivery_models.benefit2') }}</li>
                        <li><img src="{{ asset('frontend/images/icon-pricing-benefit-3.svg') }}" alt="">{{ __('site.power.delivery_models.benefit3') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="our-working-process-silver our-working-process-power-bg dark-section">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <div class="section-title section-title-center">
                    <h3 class="wow fadeInUp">{{ __('site.power.working_process.title') }}</h3>
                    <h2 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.power.working_process.subtitle') }}</h2>
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
                                <h3>{{ __('site.power.working_process.step1_title') }}</h3>
                                <p>{{ __('site.power.working_process.step1_desc') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="working-process-item-silver">
                        <div class="working-process-no-silver"><h2>2</h2></div>
                        <div class="working-process-body-silver">
                            <div class="icon-box"><img src="{{ asset('frontend/images/icon-process-item-2-silver.svg') }}" alt=""></div>
                            <div class="working-process-item-content-silver">
                                <h3>{{ __('site.power.working_process.step2_title') }}</h3>
                                <p>{{ __('site.power.working_process.step2_desc') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="working-process-item-silver">
                        <div class="working-process-no-silver"><h2>3</h2></div>
                        <div class="working-process-body-silver">
                            <div class="icon-box"><img src="{{ asset('frontend/images/icon-process-item-3-silver.svg') }}" alt=""></div>
                            <div class="working-process-item-content-silver">
                                <h3>{{ __('site.power.working_process.step3_title') }}</h3>
                                <p>{{ __('site.power.working_process.step3_desc') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="working-process-item-silver">
                        <div class="working-process-no-silver"><h2>4</h2></div>
                        <div class="working-process-body-silver">
                            <div class="icon-box"><img src="{{ asset('frontend/images/icon-process-item-4-silver.svg') }}" alt=""></div>
                            <div class="working-process-item-content-silver">
                                <h3>{{ __('site.power.working_process.step4_title') }}</h3>
                                <p>{{ __('site.power.working_process.step4_desc') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="our-testimonials-silver"><div class="container"><div class="row"><div class="col-xl-5"><div class="our-testimonial-content-silver"><div class="section-title"><h3 class="wow fadeInUp">{{ __('site.power.testimonials.title') }}</h3><h2 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.power.testimonials.subtitle') }}</h2></div></div></div><div class="col-xl-7"><div class="testimonial-slider-box"><div class="section-footer-text section-footer-contact wow fadeInUp" data-wow-delay="0.2s"><p><span><img src="{{ asset('frontend/images/icon-phone-primary.svg') }}" alt=""></span> {{ __('site.power.testimonials.prompt') }} <a href="tel:{{ preg_replace('/\s+/', '', $phone) }}">{{ $phone }}</a></p></div></div></div></div></div></div>

<div class="our-blog">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <div class="section-title section-title-center">
                    <h3 class="wow fadeInUp">{{ __('site.power.blog.title') }}</h3>
                    <h2 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.power.blog.subtitle') }}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ([1, 2, 3] as $idx => $n)
                <div class="col-xl-4 col-md-6">
                    <div class="post-item wow fadeInUp" @if($idx > 0) data-wow-delay="{{ (string) ($idx * 0.2) }}s" @endif>
                        <div class="post-featured-image">
                            <a href="{{ route('site.blog.index') }}" data-cursor-text="{{ __('site.common.view') }}">
                                <figure>
                                    <img src="{{ asset('frontend/images/post-'.$n.'.jpg') }}" alt="{{ __('site.power.blog.post'.$n) }}">
                                </figure>
                            </a>
                        </div>
                        <div class="post-item-body">
                            <div class="post-content-box">
                                <div class="post-item-content">
                                    <h2>
                                        <a href="{{ route('site.blog.index') }}" data-cursor-text="{{ __('site.common.view') }}">{{ __('site.power.blog.post'.$n) }}</a>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection

