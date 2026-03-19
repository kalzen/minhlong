<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <meta name="description" content="{{ $metaDescription ?? config('app.name') }}">
    <meta name="keywords" content="">
    <title>{{ $title ?? config('app.name') }} - {{ config('app.name') }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/images/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&amp;family=Space+Grotesk:wght@300..700&amp;display=swap" rel="stylesheet">
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('frontend/css/slicknav.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/swiper-bundle.min.css') }}">
    <link href="{{ asset('frontend/css/all.min.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('frontend/css/animate.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/mousecursor.css') }}">
    <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet" media="screen">
    @stack('head')
</head>
<body>
    <div class="preloader">
        <div class="loading-container">
            <div class="loading"></div>
            <div id="loading-icon">
                <img src="{{ asset('frontend/images/logo.png') }}" alt="{{ $settings['site_name'] ?? config('app.name') }}">
            </div>
        </div>
    </div>

    @include('partials.minhlong-header')

    <main>
        @yield('content')
    </main>

    @include('partials.minhlong-footer')

    <script src="{{ asset('frontend/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/validator.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('frontend/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/isotope.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/SmoothScroll.js') }}"></script>
    <script src="{{ asset('frontend/js/parallaxie.js') }}"></script>
    <script src="{{ asset('frontend/js/gsap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/magiccursor.js') }}"></script>
    <script src="{{ asset('frontend/js/SplitText.min.js') }}"></script>
    <script src="{{ asset('frontend/js/ScrollTrigger.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.mb.YTPlayer.min.js') }}"></script>
    <script src="{{ asset('frontend/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/js/function.js') }}"></script>
    @stack('scripts')
</body>
</html>
