@extends('layouts.minhlong')

@section('content')
<div class="page-header parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">{{ __('site.pages.services.title') }}</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('site.nav.home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('site.breadcrumb.services') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="our-services section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title section-title-center">
                    <h2>{{ __('site.pages.services.subtitle') }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
