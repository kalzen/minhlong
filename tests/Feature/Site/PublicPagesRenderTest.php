<?php

test('home page our services section links to land host minerals and power', function () {
    $response = $this->get(route('home'));

    $response->assertOk();
    $response->assertSee('favicon.svg', false);
    $response->assertSee('our-services', false);
    $response->assertSee(route('site.land'), false);
    $response->assertSee(route('site.host'), false);
    $response->assertSee(route('site.minerals'), false);
    $response->assertSee(route('site.power'), false);
    $response->assertSee('minhlong-land.webp', false);
    $response->assertSee('minhlong-host.webp', false);
    $response->assertSee('service-item--home-image-full', false);
    $response->assertSee('minerals/about-quarry-conveyors.webp', false);
    $response->assertSee('minhlong-power.webp', false);
});

test('minh long power page renders what we do stats block', function () {
    $response = $this->get(route('site.power'));

    $response->assertOk();
    $response->assertSee('power-3.webp', false);
    $response->assertSee('power-4.webp', false);
    $response->assertSee('our-working-process-power-bg', false);
    $response->assertSee('what-we-counter-box-silver', false);
    $response->assertSee('what-we-counter-info-silver', false);
    $response->assertSee('Comprehensive energy solutions', false);
});

test('minh long minerals page renders what we do stats block', function () {
    $response = $this->get(route('site.minerals'));

    $response->assertOk();
    $response->assertSee('what-we-counter-box-silver', false);
    $response->assertSee('what-we-counter-info-silver', false);
});

test('minh long host page renders and uses host image assets', function () {
    $response = $this->get(route('site.host'));

    $response->assertOk();
    $response->assertSee('hero-gold', false);
    $response->assertSee('minhlong-host-1.webp', false);
    $response->assertSee('minhlong-host-5.webp', false);
});

test('about page renders group positioning copy from translations', function () {
    $response = $this->get(route('site.about'));

    $response->assertOk();
    $response->assertSee('Shaping the Big Block', false);
    $response->assertSee('Defining the Big Block', false);
    $response->assertSee('Pyramid Journey', false);
    $response->assertSee('multi-sector conglomerate', false);
    $response->assertSee('Quality builds the foundation', false);
    $response->assertSee('Chairman of the Board', false);
});

test('home page renders minh long group organization copy', function () {
    $response = $this->get(route('home'));

    $response->assertOk();
    $response->assertSee('Minh Long Group', false);
    $response->assertSee('Minh Long Constructions delivers', false);
    $response->assertSee('At Minh Long Construction, we believe', false);
    $response->assertSee('cta-box-home-bg', false);
    $response->assertDontSee('cta-box-image.png', false);
});

test('home page about section uses pyramid journey video and shaping the big block audio', function () {
    $response = $this->get(route('home'));

    $response->assertOk();
    $response->assertSee('4hWRk3EEybA', false);
    $response->assertSee('minhlong.mp3', false);
    $response->assertSee('home-about-audio', false);
    $response->assertSee('Play audio', false);
    $response->assertSee('about-us-footer-actions', false);
    $response->assertSee('about-us-footer-actions__row', false);
});

test('home page our story section uses minh long group parallax background class', function () {
    $response = $this->get(route('home'));

    $response->assertOk();
    $response->assertSee('our-story-home-bg', false);
});
