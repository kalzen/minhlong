<?php

test('public library page renders', function () {
    $response = $this->get(route('site.library.index'));

    $response->assertOk();
    $response->assertSee(__('site.library.page_title'));
});
