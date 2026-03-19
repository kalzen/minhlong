@extends('layouts.minhlong')

@section('content')
@php
    $phone = $settings['contact_phone'] ?? '088 6656 899';
    $email = $settings['contact_email'] ?? 'info@mlgroup.vn';
    $address = $settings['contact_address'] ?? 'Minh Long Group, Viet Nam';
    $phoneLink = str_replace(' ', '', $phone);
@endphp
<div class="page-header parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">Contact us</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('site.home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contact us</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-contact-us">
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="row align-items-center">
            <div class="col-xl-5">
                <div class="contact-us-content">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Contact Us</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Let's connect & build your dream project</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">We'd love to hear about your project. Reach out, share your ideas, and let's start shaping your dream into something real and lasting.</p>
                    </div>
                    <div class="contact-info-list">
                        <div class="contact-info-item wow fadeInUp">
                            <div class="icon-box">
                                <img src="{{ asset('frontend') }}/images/icon-phone-primary.svg" alt="">
                            </div>
                            <div class="contact-info-item-content">
                                <h3>Phone Number</h3>
                                <p><a href="tel:{{ $phoneLink }}">{{ $phone }}</a></p>
                            </div>
                        </div>
                        <div class="contact-info-item wow fadeInUp" data-wow-delay="0.2s">
                            <div class="icon-box">
                                <img src="{{ asset('frontend') }}/images/icon-mail-primary.svg" alt="">
                            </div>
                            <div class="contact-info-item-content">
                                <h3>Email Address</h3>
                                <p><a href="mailto:{{ $email }}">{{ $email }}</a></p>
                            </div>
                        </div>
                        <div class="contact-info-item wow fadeInUp" data-wow-delay="0.4s">
                            <div class="icon-box">
                                <img src="{{ asset('frontend') }}/images/icon-location-primary.svg" alt="">
                            </div>
                            <div class="contact-info-item-content">
                                <h3>Our Location</h3>
                                <p>{{ $address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-7">
                <div class="contact-us-form">
                    <div class="section-title">
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Get in touch with us</h2>
                        <p class="wow fadeInUp">Need help or have a project? Get in touch — we're always ready to support you.</p>
                    </div>
                    <div class="contact-form">
                        <form action="{{ route('site.contact.store') }}" method="POST" class="wow fadeInUp" data-wow-delay="0.2s">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12 mb-4">
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Họ tên *" value="{{ old('name') }}" required>
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group col-md-6 mb-4">
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email *" value="{{ old('email') }}" required>
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group col-md-6 mb-4">
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Số điện thoại" value="{{ old('phone') }}">
                                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group col-md-12 mb-5">
                                    <textarea name="message" class="form-control @error('message') is-invalid @enderror" id="message" rows="6" placeholder="Nội dung">{{ old('message') }}</textarea>
                                    @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-lg-12">
                                    <div class="contact-form-btn">
                                        <button type="submit" class="btn-default"><span>Gửi tin nhắn</span></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
