@php
    $addressHaiphong = $settings['contact_address_haiphong'] ?? null;
    $addressHanoi = $settings['contact_address_hanoi'] ?? null;
    $addressLegacy = $settings['contact_address'] ?? null;
@endphp
@if (filled($addressHaiphong) || filled($addressHanoi))
    @if (filled($addressHaiphong))
        <p class="contact-address-block__line mb-2">
            <strong>{{ __('site.footer.address_haiphong') }}:</strong>
            {{ $addressHaiphong }}
        </p>
    @endif
    @if (filled($addressHanoi))
        <p class="contact-address-block__line mb-0">
            <strong>{{ __('site.footer.address_hanoi') }}:</strong>
            {{ $addressHanoi }}
        </p>
    @endif
@elseif (filled($addressLegacy))
    <p class="mb-0">{{ $addressLegacy }}</p>
@else
    <p class="mb-0">{{ __('site.footer.address_fallback') }}</p>
@endif
