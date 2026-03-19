<header class="main-header">
    <div class="header-sticky">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('site.home') }}">
                    <img src="{{ asset('frontend/images/logo.png') }}" alt="{{ $settings['site_name'] ?? config('app.name') }}" style="height: 40px; width: auto;">
                    <span style="color: #ffffff; font-weight: 700; letter-spacing: 0.08em;">MINH LONG</span>
                </a>
                        <div class="collapse navbar-collapse main-menu">
                    <div class="nav-menu-wrapper">
                        <ul class="navbar-nav mr-auto" id="menu">
                            <li class="nav-item"><a class="nav-link" href="{{ route('site.home') }}">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('site.about') }}">About Us</a></li>
                            <li class="nav-item submenu">
                                <a class="nav-link d-flex align-items-center gap-1" href="{{ route('site.services') }}">
                                    <span>Services</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-chevron-down" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </a>
                                <ul>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('site.land') }}">Minh Long Land</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('site.power') }}">Minh Long Power</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('site.blog.index') }}">Blog</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('site.contact') }}">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="header-btn">
                        <a href="{{ route('site.contact') }}" class="btn-default btn-highlighted">Contact Us</a>
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
