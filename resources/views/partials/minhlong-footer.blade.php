@php
    $phone = $settings['contact_phone'] ?? '088 6656 899';
    $email = $settings['contact_email'] ?? 'info@mlgroup.vn';
    $siteName = $settings['site_name'] ?? config('app.name');
@endphp
<footer class="main-footer dark-section">
    <div class="footer-scrolling-ticker">
        <div class="scrolling-ticker-box">
            <div class="scrolling-content">
                <span><img src="{{ asset('frontend/images/icon-asterisk.svg') }}" alt="">Industrial EPC</span>
                <span><img src="{{ asset('frontend/images/icon-asterisk.svg') }}" alt="">Factory Construction</span>
                <span><img src="{{ asset('frontend/images/icon-asterisk.svg') }}" alt="">Steel Structure Works</span>
                <span><img src="{{ asset('frontend/images/icon-asterisk.svg') }}" alt="">M&amp;E Systems</span>
                <span><img src="{{ asset('frontend/images/icon-asterisk.svg') }}" alt="">Fire Protection (PCCC)</span>
                <span><img src="{{ asset('frontend/images/icon-asterisk.svg') }}" alt="">Industrial Zone Projects</span>
                <span><img src="{{ asset('frontend/images/icon-asterisk.svg') }}" alt="">Turnkey Delivery</span>
                <span><img src="{{ asset('frontend/images/icon-asterisk.svg') }}" alt="">Schedule &amp; Safety Commitment</span>
                <span><img src="{{ asset('frontend/images/icon-asterisk.svg') }}" alt="">Quality Control (QA/QC)</span>
                <span><img src="{{ asset('frontend/images/icon-asterisk.svg') }}" alt="">Cost-Optimized Execution</span>
                <span><img src="{{ asset('frontend/images/icon-asterisk.svg') }}" alt="">Industrial EPC</span>
            </div>
            <div class="scrolling-content">
                <span><img src="{{ asset('frontend/images/icon-asterisk.svg') }}" alt="">Factory Construction</span>
                <span><img src="{{ asset('frontend/images/icon-asterisk.svg') }}" alt="">Industrial EPC</span>
                <span><img src="{{ asset('frontend/images/icon-asterisk.svg') }}" alt="">M&amp;E Systems</span>
                <span><img src="{{ asset('frontend/images/icon-asterisk.svg') }}" alt="">Steel Structure Works</span>
                <span><img src="{{ asset('frontend/images/icon-asterisk.svg') }}" alt="">Industrial Zone Projects</span>
                <span><img src="{{ asset('frontend/images/icon-asterisk.svg') }}" alt="">Fire Protection (PCCC)</span>
                <span><img src="{{ asset('frontend/images/icon-asterisk.svg') }}" alt="">Cost-Optimized Execution</span>
                <span><img src="{{ asset('frontend/images/icon-asterisk.svg') }}" alt="">Turnkey Delivery</span>
                <span><img src="{{ asset('frontend/images/icon-asterisk.svg') }}" alt="">QA/QC Standards</span>
                <span><img src="{{ asset('frontend/images/icon-asterisk.svg') }}" alt="">Schedule &amp; Safety Commitment</span>
                <span><img src="{{ asset('frontend/images/icon-asterisk.svg') }}" alt="">Factory Construction</span>
            </div>
        </div>
    </div>

    <div class="footer-box">
        <div class="container">
            <div class="row">
                <div class="col-xl-4">
                    <div class="about-footer">
                        <div class="footer-logo d-flex align-items-center gap-2">
                            <img src="{{ asset('frontend/images/logo.png') }}" alt="{{ $siteName }}" style="height: 40px; width: auto;">
                            <span style="color: #ffffff; font-weight: 700; letter-spacing: 0.08em;">MINH LONG GROUP</span>
                        </div>
                        <div class="footer-working-hours">
                            <h3>{{ __('site.footer.working_hours') }}</h3>
                            <ul>
                                <li>Monday - Friday: 09:00 AM - 06:00 PM</li>
                                <li>Saturday - Sunday: Closed</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <div class="footer-links-box">
                        <div class="footer-links footer-location-info">
                            <h3>{{ __('site.footer.contact_information') }}</h3>
                            <div class="footer-address-block">
                                @include('partials.contact-address-block')
                            </div>
                        </div>
                        <div class="footer-links footer-contact-links">
                            <h3>{{ __('site.footer.get_in_touch') }}</h3>
                            <ul>
                                <li><img src="{{ asset('frontend/images/icon-phone-white.svg') }}" alt=""> Phone: <a href="tel:{{ preg_replace('/\s+/', '', $phone) }}">{{ $phone }}</a></li>
                                <li><img src="{{ asset('frontend/images/icon-mail-white.svg') }}" alt=""> Email: <a href="mailto:{{ $email }}">{{ $email }}</a></li>
                            </ul>
                        </div>
                        <div class="footer-links footer-newsletter-form">
                            <h3>{{ __('site.footer.newsletter_title') }}</h3>
                            <p>{{ __('site.footer.newsletter_body') }}</p>
                            <form id="newslettersForm" action="#" method="POST">
                                <div class="form-group">
                                    <input type="email" name="mail" class="form-control" id="mail" placeholder="Enter Email Address*" required>
                                    <button type="submit" class="newsletter-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-send" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="m22 2-7 20-4-9-9-4Z"></path>
                                            <path d="M22 2 11 13"></path>
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                        @include('partials.social-footer-links')
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="footer-copyright">
                        <div class="footer-menu">
                            <ul>
                                <li><a href="{{ route('home') }}">{{ __('site.footer.menu.home') }}</a></li>
                                <li><a href="{{ route('site.about') }}">{{ __('site.footer.menu.about') }}</a></li>
                                <li><a href="{{ route('site.services') }}">{{ __('site.footer.menu.service') }}</a></li>
                                <li><a href="{{ route('site.blog.index') }}">{{ __('site.footer.menu.blog') }}</a></li>
                                <li><a href="{{ route('site.contact') }}">{{ __('site.footer.menu.contact') }}</a></li>
                            </ul>
                        </div>
                        <div class="footer-copyright-text">
                            <p>Copyright © {{ date('Y') }} {{ $siteName }}. All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
