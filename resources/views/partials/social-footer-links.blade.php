@php
    $socialFacebook = $settings['social_facebook'] ?? null;
    $socialLinkedin = $settings['social_linkedin'] ?? null;
    $socialInstagram = $settings['social_instagram'] ?? null;
    $socialYoutube = $settings['social_youtube'] ?? null;
    $socialZalo = $settings['social_zalo'] ?? null;
    $hasAnySocial = filled($socialFacebook) || filled($socialLinkedin) || filled($socialInstagram) || filled($socialYoutube) || filled($socialZalo);
@endphp
@if ($hasAnySocial)
    <div class="footer-links footer-social-links">
        <h3>{{ __('site.footer.follow_on_socials') }}</h3>
        <ul>
            @if (filled($socialFacebook))
                <li>
                    <a href="{{ $socialFacebook }}" target="_blank" rel="noopener noreferrer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-facebook" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3.5L18 10h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                        {{ __('site.footer.social_facebook') }}
                    </a>
                </li>
            @endif
            @if (filled($socialLinkedin))
                <li>
                    <a href="{{ $socialLinkedin }}" target="_blank" rel="noopener noreferrer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-linkedin" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></svg>
                        {{ __('site.footer.social_linkedin') }}
                    </a>
                </li>
            @endif
            @if (filled($socialInstagram))
                <li>
                    <a href="{{ $socialInstagram }}" target="_blank" rel="noopener noreferrer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-instagram" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                        {{ __('site.footer.social_instagram') }}
                    </a>
                </li>
            @endif
            @if (filled($socialYoutube))
                <li>
                    <a href="{{ $socialYoutube }}" target="_blank" rel="noopener noreferrer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-youtube" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"/><polygon points="9.5 8.5 16 12 9.5 15.5 9.5 8.5"/></svg>
                        {{ __('site.footer.social_youtube') }}
                    </a>
                </li>
            @endif
            @if (filled($socialZalo))
                <li>
                    <a href="{{ $socialZalo }}" target="_blank" rel="noopener noreferrer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-zalo" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><path d="M8 10h.01"/><path d="M12 10h.01"/><path d="M16 10h.01"/></svg>
                        {{ __('site.footer.social_zalo') }}
                    </a>
                </li>
            @endif
        </ul>
    </div>
@endif
