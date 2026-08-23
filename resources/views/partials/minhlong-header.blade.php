<header class="main-header">
    <div class="header-sticky">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                    <img src="{{ \App\Support\SiteMedia::urlOrDefault('brand.logo_header') }}" alt="{{ $settings['site_name'] ?? config('app.name') }}" style="height: 40px; width: auto;">
                    <span style="color: #ffffff; font-weight: 700; letter-spacing: 0.08em;">MINH LONG GROUP</span>
                </a>
                        <div class="collapse navbar-collapse main-menu">
                    <div class="nav-menu-wrapper">
                        @php
                            $locale = app()->getLocale();
                                $flagSrc = match ($locale) {
                                    'vi' => asset('frontend/images/flag/vietnam.png'),
                                    'zh' => asset('frontend/images/flag/china.png'),
                                    default => asset('frontend/images/flag/united-states.png'),
                                };
                        @endphp
                        <ul class="navbar-nav mr-auto" id="menu">
                            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">{{ __('site.nav.home') }}</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('site.about') }}">{{ __('site.nav.about') }}</a></li>
                            <li class="nav-item submenu">
                                <a class="nav-link d-flex align-items-center gap-1" href="{{ route('site.services') }}">
                                    <span>{{ __('site.nav.services') }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-chevron-down" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </a>
                                <ul>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('site.land') }}">Minh Long Land</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('site.power') }}">Minh Long Power</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('site.minerals') }}">Minh Long Minerals</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('site.host') }}">Minh Long Host</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('site.blog.index') }}">{{ __('site.nav.blog') }}</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('site.contact') }}">{{ __('site.nav.contact') }}</a></li>
                            <li class="nav-item submenu">
                                <a class="nav-link d-flex align-items-center gap-1" href="javascript:void(0)">
                                    <img src="{{ $flagSrc }}" alt="{{ $locale }}" width="18" height="18" style="border-radius:999px; object-fit:cover; margin-right:2px;">
                                    <span class="d-none d-lg-inline">{{ strtoupper($locale) }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-chevron-down" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </a>
                                <ul>
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center" href="{{ $localeSwitchUrls['en'] }}">
                                            <img src="{{ asset('frontend/images/flag/united-states.png') }}" alt="English" width="18" height="18" style="border-radius:999px; object-fit:cover; margin-right:8px;">
                                            {{ __('site.lang.english') }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center" href="{{ $localeSwitchUrls['vi'] }}">
                                            <img src="{{ asset('frontend/images/flag/vietnam.png') }}" alt="Tiếng Việt" width="18" height="18" style="border-radius:999px; object-fit:cover; margin-right:8px;">
                                            {{ __('site.lang.vietnamese') }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center" href="{{ $localeSwitchUrls['zh'] }}">
                                            <img src="{{ asset('frontend/images/flag/china.png') }}" alt="中文" width="18" height="18" style="border-radius:999px; object-fit:cover; margin-right:8px;">
                                            {{ __('site.lang.chinese') }}
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="header-btn">
                        <a href="{{ route('site.contact') }}" class="btn-default btn-highlighted">{{ __('site.nav.contact_cta') }}</a>
                    </div>
                        </div>
                        <div class="navbar-toggle">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-menu" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="4" y1="6" x2="20" y2="6"></line>
                                <line x1="4" y1="12" x2="20" y2="12"></line>
                                <line x1="4" y1="18" x2="20" y2="18"></line>
                            </svg>
                        </div>
            </div>
        </nav>
        <div class="responsive-menu"></div>
    </div>
</header>
