<?php

test('home page our services section links to land host minerals and power', function () {
    $response = $this->get(route('home'));

    $response->assertOk();
    $response->assertSee('our-services', false);
    $response->assertSee(route('site.land'), false);
    $response->assertSee(route('site.host'), false);
    $response->assertSee(route('site.minerals'), false);
    $response->assertSee(route('site.power'), false);
    $response->assertSee('hero-image-gold.jpg', false);
    $response->assertSee('minhlong-host-1.png', false);
    $response->assertSee('minerals/about-quarry-conveyors.png', false);
    $response->assertSee('hero-image-silver.png', false);
});

test('minh long power page renders what we do stats block', function () {
    $response = $this->get(route('site.power'));

    $response->assertOk();
    $response->assertSee('what-we-counter-box-silver', false);
    $response->assertSee('what-we-counter-info-silver', false);
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
    $response->assertSee('minhlong-host-1.png', false);
    $response->assertSee('minhlong-host-5.JPG', false);
});
