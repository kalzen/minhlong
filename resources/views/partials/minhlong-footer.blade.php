@php
    $phone = $settings['contact_phone'] ?? '088 6656 899';
    $email = $settings['contact_email'] ?? 'info@mlgroup.vn';
    $address = $settings['contact_address'] ?? 'Minh Long Group, Viet Nam';
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
                            <span style="color: #ffffff; font-weight: 700; letter-spacing: 0.08em;">MINH LONG</span>
                        </div>
                        <div class="footer-working-hours">
                            <h3>Working Hours:</h3>
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
                            <h3>Contact Information</h3>
                            <p>{{ $address }}</p>
                        </div>
                        <div class="footer-links footer-contact-links">
                            <h3>Get in Touch</h3>
                            <ul>
                                <li><img src="{{ asset('frontend/images/icon-phone-white.svg') }}" alt=""> Phone: <a href="tel:{{ preg_replace('/\s+/', '', $phone) }}">{{ $phone }}</a></li>
                                <li><img src="{{ asset('frontend/images/icon-mail-white.svg') }}" alt=""> Email: <a href="mailto:{{ $email }}">{{ $email }}</a></li>
                            </ul>
                        </div>
                        <div class="footer-links footer-newsletter-form">
                            <h3>Newsletter Subscription</h3>
                            <p>Stay updated on our latest projects, tips, and offers.</p>
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
                        <div class="footer-links footer-social-links">
                            <h3>Follow On Socials:</h3>
                            <ul>
                                <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-dribbble" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M8 2.1a10 10 0 0 1 4 7.9 19.5 19.5 0 0 1 7.5-.6"/><path d="M6.3 5.3a10 10 0 0 0 4.9 4.2 19.4 19.4 0 0 0-6.2 7.1"/><path d="M12.5 12.5a19.3 19.3 0 0 1 3.5 7.4"/></svg>Dribbble</a></li>
                                <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-facebook" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3.5L18 10h-4V7a1 1 0 0 1 1-1h3z"/></svg> Facebook</a></li>
                                <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-linkedin" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></svg>LinkedIn</a></li>
                                <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-instagram" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>Instagram</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="footer-copyright">
                        <div class="footer-menu">
                            <ul>
                                <li><a href="{{ route('site.home') }}">Home</a></li>
                                <li><a href="{{ route('site.about') }}">About Us</a></li>
                                <li><a href="{{ route('site.services') }}">Service</a></li>
                                <li><a href="{{ route('site.blog.index') }}">Blog</a></li>
                                <li><a href="{{ route('site.contact') }}">Contact</a></li>
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
