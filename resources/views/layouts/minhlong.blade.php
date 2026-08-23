<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @php
        $siteName = $settings['site_name'] ?? config('app.name');
        $globalMetaTitle = $settings['meta_title'] ?? $settings['default_meta_title'] ?? null;
        $seoDescription = $metaDescription ?? $settings['meta_description'] ?? $settings['default_meta_description'] ?? null;
        $seoKeywords = $settings['meta_keywords'] ?? '';
        $ogType = $ogType ?? $settings['og_type'] ?? 'website';
        $currentLocale = app()->getLocale();
        $ogLocaleMap = ['en' => 'en_US', 'vi' => 'vi_VN', 'zh' => 'zh_CN'];
        $defaultLocale = \App\Support\SitePages::defaultLocale();
        // Blog posts supply their own sibling URLs; every other page derives them
        // from the locale variants of the route currently being served.
        $pageAlternates = $hreflangAlternates ?? \App\Support\SitePages::alternatesForCurrentRoute();
        $localeSwitchUrls = [];
        foreach (\App\Support\SitePages::locales() as $switchLocale) {
            $localeSwitchUrls[$switchLocale] = $pageAlternates[$switchLocale]
                ?? route('home.'.$switchLocale);
        }
        $canonicalUrl = url()->current();
        $canonicalPage = (int) request()->query('page', 1);
        if ($canonicalPage > 1) {
            $canonicalUrl .= '?page='.$canonicalPage;
        }
        $twitterCard = $settings['twitter_card'] ?? 'summary_large_image';
        $metaRobots = $settings['meta_robots'] ?? 'index, follow';
        $useHomeMetaTitle = request()->routeIs('home.*') && filled($globalMetaTitle);
        $documentTitle = $useHomeMetaTitle
            ? $globalMetaTitle
            : (($metaTitle ?? $title ?? $globalMetaTitle ?? $siteName).' - '.$siteName);
        $ogOverride = trim((string) ($ogImageUrl ?? ''));
        $ogImageRaw = $ogOverride !== ''
            ? $ogOverride
            : \App\Support\SiteMedia::urlOrDefault('og.default_image');
        $ogImageAbsolute = $ogImageRaw !== '' ? \App\Support\SiteMedia::absoluteUrl($ogImageRaw) : '';
        // The hero/page-header artwork is a CSS background, so the browser only
        // discovers it after the stylesheet parses. Preloading it removes that
        // delay from LCP, which measured 590 ms on the home page.
        $lcpBackground = match (true) {
            request()->routeIs('home.*') => 'frontend/images/hero-bg-image.webp',
            request()->routeIs('site.power.*', 'site.minerals.*') => 'frontend/images/hero-bg-image-silver.webp',
            request()->routeIs('site.land.*', 'site.host.*') => 'frontend/images/hero-gold-bg-shape.png',
            default => 'frontend/images/page-header-bg.webp',
        };
    @endphp
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $seoDescription ?? $siteName }}">
    @if(filled($seoKeywords))
        <meta name="keywords" content="{{ $seoKeywords }}">
    @endif
    <meta name="robots" content="{{ $metaRobots }}">
    <link rel="canonical" href="{{ $canonicalUrl }}">
    @foreach($pageAlternates as $alternateLocale => $alternateUrl)
        <link rel="alternate" hreflang="{{ $alternateLocale }}" href="{{ $alternateUrl }}">
    @endforeach
    @if(isset($pageAlternates[$defaultLocale]))
        <link rel="alternate" hreflang="x-default" href="{{ $pageAlternates[$defaultLocale] }}">
    @endif
    <title>{{ $documentTitle }}</title>
    <meta property="og:type" content="{{ $ogType }}">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:title" content="{{ $documentTitle }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($seoDescription ?? $siteName), 300) }}">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:locale" content="{{ $ogLocaleMap[$currentLocale] ?? 'en_US' }}">
    @foreach($ogLocaleMap as $localeCode => $ogLocale)
        @if($localeCode !== $currentLocale)
            <meta property="og:locale:alternate" content="{{ $ogLocale }}">
        @endif
    @endforeach
    @if($ogImageAbsolute !== '')
        <meta property="og:image" content="{{ $ogImageAbsolute }}">
        <meta property="og:image:alt" content="{{ $documentTitle }}">
    @endif
    <meta name="twitter:card" content="{{ $twitterCard }}">
    <meta name="twitter:title" content="{{ $documentTitle }}">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($seoDescription ?? $siteName), 200) }}">
    @if($ogImageAbsolute !== '')
        <meta name="twitter:image" content="{{ $ogImageAbsolute }}">
    @endif
    <link rel="preload" as="image" href="{{ asset($lcpBackground) }}" fetchpriority="high">
    <link rel="icon" href="{{ \App\Support\SiteMedia::urlOrDefault('brand.favicon') }}">
    <meta name="theme-color" content="#0b0b0b">
    @include('partials.seo-structured-data')
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&amp;family=Space+Grotesk:wght@300..700&amp;display=swap" rel="stylesheet">
    @if(app()->getLocale() === 'vi')
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&amp;display=swap" rel="stylesheet">
        <style>
            :root {
                --default-font: "Inter", sans-serif;
            }
        </style>
    @endif
    <link href="{{ \App\Support\AssetVersion::url('frontend/css/bootstrap.min.css') }}" rel="stylesheet" media="screen">
    <link href="{{ \App\Support\AssetVersion::url('frontend/css/slicknav.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ \App\Support\AssetVersion::url('frontend/css/swiper-bundle.min.css') }}">
    <link href="{{ \App\Support\AssetVersion::url('frontend/css/all.min.css') }}" rel="stylesheet" media="screen">
    <link href="{{ \App\Support\AssetVersion::url('frontend/css/animate.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ \App\Support\AssetVersion::url('frontend/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ \App\Support\AssetVersion::url('frontend/css/mousecursor.css') }}">
    <link href="{{ \App\Support\AssetVersion::url('frontend/css/custom.css') }}" rel="stylesheet" media="screen">
    @stack('head')
</head>
<body>
    <div class="preloader">
        <div class="loading-container">
            <div class="loading"></div>
            <div id="loading-icon">
                <img src="{{ \App\Support\SiteMedia::urlOrDefault('brand.logo_header') }}" alt="{{ $settings['site_name'] ?? config('app.name') }}">
            </div>
        </div>
    </div>

    @include('partials.minhlong-header')

    <main>
        @yield('content')
    </main>

    @include('partials.minhlong-footer')

    @if(!session()->has('locale'))
        <div
            class="modal fade"
            id="localeModal"
            tabindex="-1"
            aria-labelledby="localeModalLabel"
            aria-hidden="true"
            data-show="1"
        >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border-radius: 14px; overflow: hidden; border: 0;">
                    <div class="modal-header" style="border: 0; background: #0b0b0b;">
                        <h5 class="modal-title" id="localeModalLabel" style="color: #fff;">
                            {{ __('site.lang.choose') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="padding: 18px;">
                        <div class="d-grid gap-2">
                            <a class="btn btn-lg btn-outline-dark d-flex align-items-center justify-content-center" href="{{ $localeSwitchUrls['en'] }}">
                                <img src="{{ asset('frontend/images/flag/united-states.png') }}" alt="English" width="20" height="20" style="border-radius:999px; object-fit:cover; margin-right:8px;">
                                {{ __('site.lang.english') }}
                            </a>
                            <a class="btn btn-lg btn-outline-dark d-flex align-items-center justify-content-center" href="{{ $localeSwitchUrls['vi'] }}">
                                <img src="{{ asset('frontend/images/flag/vietnam.png') }}" alt="Tiếng Việt" width="20" height="20" style="border-radius:999px; object-fit:cover; margin-right:8px;">
                                {{ __('site.lang.vietnamese') }}
                            </a>
                            <a class="btn btn-lg btn-outline-dark d-flex align-items-center justify-content-center" href="{{ $localeSwitchUrls['zh'] }}">
                                <img src="{{ asset('frontend/images/flag/china.png') }}" alt="中文" width="20" height="20" style="border-radius:999px; object-fit:cover; margin-right:8px;">
                                {{ __('site.lang.chinese') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const modalEl = document.getElementById('localeModal');
                if (!modalEl) return;

                if (modalEl.dataset.show === '1' && window.bootstrap?.Modal) {
                    const modal = new window.bootstrap.Modal(modalEl);
                    modal.show();
                }
            });
        </script>
    @endif

    <script src="{{ \App\Support\AssetVersion::url('frontend/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ \App\Support\AssetVersion::url('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ \App\Support\AssetVersion::url('frontend/js/validator.min.js') }}"></script>
    <script src="{{ \App\Support\AssetVersion::url('frontend/js/jquery.slicknav.js') }}"></script>
    <script src="{{ \App\Support\AssetVersion::url('frontend/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ \App\Support\AssetVersion::url('frontend/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ \App\Support\AssetVersion::url('frontend/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ \App\Support\AssetVersion::url('frontend/js/isotope.min.js') }}"></script>
    <script src="{{ \App\Support\AssetVersion::url('frontend/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ \App\Support\AssetVersion::url('frontend/js/SmoothScroll.js') }}"></script>
    <script src="{{ \App\Support\AssetVersion::url('frontend/js/parallaxie.js') }}"></script>
    <script src="{{ \App\Support\AssetVersion::url('frontend/js/gsap.min.js') }}"></script>
    <script src="{{ \App\Support\AssetVersion::url('frontend/js/magiccursor.js') }}"></script>
    <script src="{{ \App\Support\AssetVersion::url('frontend/js/SplitText.min.js') }}"></script>
    <script src="{{ \App\Support\AssetVersion::url('frontend/js/ScrollTrigger.min.js') }}"></script>
    <script src="{{ \App\Support\AssetVersion::url('frontend/js/jquery.mb.YTPlayer.min.js') }}"></script>
    <script src="{{ \App\Support\AssetVersion::url('frontend/js/wow.min.js') }}"></script>
    <script src="{{ \App\Support\AssetVersion::url('frontend/js/function.js') }}"></script>
    @stack('scripts')
</body>
</html>
