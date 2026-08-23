<?php

/*
|--------------------------------------------------------------------------
| Localized public pages
|--------------------------------------------------------------------------
|
| Every public page gets its own slug per locale so that one URL always
| serves exactly one language. That is what lets Google index all three
| versions instead of only whichever language the session happened to hold.
|
| The Vietnamese slugs are the ones the site already used, so existing links
| and any indexed URLs keep working unchanged. English and Chinese slugs are
| additions. Route names are suffixed with the locale, e.g. `site.about.vi`;
| calling route('site.about') resolves to the current locale automatically.
|
*/

return [

    'locales' => ['vi', 'en', 'zh'],

    /*
     | The locale served at "/" and advertised as hreflang="x-default".
     */
    'default_locale' => 'en',

    'pages' => [

        'home' => [
            'name' => 'home',
            'seo' => 'home',
            'slugs' => ['en' => '', 'vi' => 'vi', 'zh' => 'zh'],
        ],

        'about' => [
            'name' => 'site.about',
            'view' => 'site.about',
            'seo' => 'about',
            'slugs' => ['vi' => 'gioi-thieu', 'en' => 'about-us', 'zh' => 'guanyu-women'],
        ],

        'services' => [
            'name' => 'site.services',
            'view' => 'site.services',
            'seo' => 'services',
            'slugs' => ['vi' => 'dich-vu', 'en' => 'services', 'zh' => 'fuwu'],
        ],

        'land' => [
            'name' => 'site.land',
            'view' => 'site.land',
            'seo' => 'land',
            'slugs' => [
                'vi' => 'minh-long-land',
                'en' => 'minh-long-land-real-estate',
                'zh' => 'minh-long-land-fangdichan',
            ],
        ],

        'power' => [
            'name' => 'site.power',
            'view' => 'site.power',
            'seo' => 'power',
            'slugs' => [
                'vi' => 'minh-long-power',
                'en' => 'minh-long-power-energy',
                'zh' => 'minh-long-power-nengyuan',
            ],
        ],

        'host' => [
            'name' => 'site.host',
            'view' => 'site.host',
            'seo' => 'host',
            'slugs' => [
                'vi' => 'minh-long-host',
                'en' => 'minh-long-host-operations',
                'zh' => 'minh-long-host-yunying',
            ],
        ],

        'minerals' => [
            'name' => 'site.minerals',
            'view' => 'site.minerals',
            'seo' => 'minerals',
            'slugs' => [
                'vi' => 'minh-long-minerals',
                'en' => 'minh-long-minerals-supply',
                'zh' => 'minh-long-minerals-kuangchan',
            ],
        ],

        'blog' => [
            'name' => 'site.blog.index',
            'seo' => 'blog',
            'slugs' => ['vi' => 'blog', 'en' => 'news', 'zh' => 'xinwen'],
        ],

        'contact' => [
            'name' => 'site.contact',
            'seo' => 'contact',
            'slugs' => ['vi' => 'lien-he', 'en' => 'contact-us', 'zh' => 'lianxi-women'],
        ],

        'library' => [
            'name' => 'site.library.index',
            'seo' => 'library',
            'slugs' => ['vi' => 'thu-vien', 'en' => 'document-library', 'zh' => 'ziliaoku'],
            'download_slugs' => ['vi' => 'tai-xuong', 'en' => 'download', 'zh' => 'xiazai'],
        ],

    ],
];
