@php
    /**
     * JSON-LD structured data shared by every public page.
     *
     * Emits Organization + WebSite on all pages, a BreadcrumbList derived from the
     * current route, and BlogPosting when the view exposes a $post.
     */
    $schemaSiteName = $settings['site_name'] ?? config('app.name');
    $schemaLogo = \App\Support\SiteMedia::urlOrDefault('brand.logo_header');
    $schemaLogoAbsolute = $schemaLogo !== '' ? \App\Support\SiteMedia::absoluteUrl($schemaLogo) : null;

    $schemaSameAs = collect([
        $settings['social_facebook'] ?? null,
        $settings['social_linkedin'] ?? null,
        $settings['social_instagram'] ?? null,
        $settings['social_youtube'] ?? null,
    ])->filter(fn ($url) => filled($url) && str_starts_with((string) $url, 'http'))->values()->all();

    $schemaOrganization = array_filter([
        '@type' => 'Organization',
        '@id' => url('/').'#organization',
        'name' => $schemaSiteName,
        'url' => url('/'),
        'logo' => $schemaLogoAbsolute,
        'description' => $settings['meta_description'] ?? $settings['default_meta_description'] ?? null,
        'email' => $settings['contact_email'] ?? null,
        'telephone' => $settings['contact_phone'] ?? null,
        'address' => filled($settings['contact_address_haiphong'] ?? null) ? array_filter([
            '@type' => 'PostalAddress',
            'streetAddress' => $settings['contact_address_haiphong'] ?? null,
            'addressCountry' => 'VN',
        ]) : null,
        'sameAs' => $schemaSameAs !== [] ? $schemaSameAs : null,
    ], fn ($value) => $value !== null && $value !== '');

    $schemaWebsite = [
        '@type' => 'WebSite',
        '@id' => url('/').'#website',
        'url' => url('/'),
        'name' => $schemaSiteName,
        'inLanguage' => $currentLocale ?? app()->getLocale(),
        'publisher' => ['@id' => url('/').'#organization'],
    ];

    $schemaGraph = [$schemaOrganization, $schemaWebsite];

    // Breadcrumbs: Home > (section) > (current page)
    $breadcrumbItems = [[
        'name' => __('site.nav.home'),
        'url' => route('home'),
    ]];

    if (isset($post) && $post instanceof \App\Models\Post) {
        $breadcrumbItems[] = ['name' => __('site.breadcrumb.blog'), 'url' => route('site.blog.index')];
        $breadcrumbItems[] = ['name' => $post->title, 'url' => route('site.blog.show.'.$post->locale, ['slug' => $post->slug])];
    } elseif (! request()->routeIs('home.*')) {
        $breadcrumbItems[] = [
            'name' => $metaTitle ?? $title ?? $schemaSiteName,
            'url' => $canonicalUrl ?? url()->current(),
        ];
    }

    if (count($breadcrumbItems) > 1) {
        $schemaGraph[] = [
            '@type' => 'BreadcrumbList',
            '@id' => ($canonicalUrl ?? url()->current()).'#breadcrumb',
            'itemListElement' => collect($breadcrumbItems)->values()->map(fn ($item, $index) => [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $item['name'],
                'item' => $item['url'],
            ])->all(),
        ];
    }

    if (isset($post) && $post instanceof \App\Models\Post) {
        $postImage = $post->publicFeaturedImageUrl();

        $schemaGraph[] = array_filter([
            '@type' => 'BlogPosting',
            '@id' => route('site.blog.show.'.$post->locale, ['slug' => $post->slug]).'#article',
            'headline' => \Illuminate\Support\Str::limit($post->title, 110, ''),
            'description' => \Illuminate\Support\Str::limit(strip_tags((string) ($post->meta_description ?? $post->excerpt ?? '')), 300),
            'image' => filled($postImage) ? \App\Support\SiteMedia::absoluteUrl($postImage) : null,
            'inLanguage' => $post->locale,
            'datePublished' => optional($post->published_at ?? $post->created_at)->toAtomString(),
            'dateModified' => optional($post->updated_at)->toAtomString(),
            'mainEntityOfPage' => ['@type' => 'WebPage', '@id' => route('site.blog.show.'.$post->locale, ['slug' => $post->slug])],
            'author' => ['@id' => url('/').'#organization'],
            'publisher' => ['@id' => url('/').'#organization'],
            'articleSection' => $post->category?->name,
        ], fn ($value) => $value !== null && $value !== '');
    }

    $schemaPayload = [
        '@context' => 'https://schema.org',
        '@graph' => $schemaGraph,
    ];
@endphp
<script type="application/ld+json">{!! json_encode($schemaPayload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
