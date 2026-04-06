/** Locales supported for flag icons (public/frontend/images/flag/). */
export const LOCALE_ORDER = ['en', 'vi', 'zh'] as const;

export type LocaleCode = string;

export function localeFlagSrc(locale: string): string | null {
    switch (locale) {
        case 'en':
            return '/frontend/images/flag/united-states.png';
        case 'vi':
            return '/frontend/images/flag/vietnam.png';
        case 'zh':
            return '/frontend/images/flag/china.png';
        default:
            return null;
    }
}

export function localeTitle(locale: string): string {
    const labels: Record<string, string> = {
        en: 'English',
        vi: 'Tiếng Việt',
        zh: '中文',
    };

    return labels[locale] ?? locale;
}

export function sortLocales(locales: string[]): string[] {
    const set = [...new Set(locales)];

    return set.sort((a, b) => {
        const ia = LOCALE_ORDER.indexOf(a as (typeof LOCALE_ORDER)[number]);
        const ib = LOCALE_ORDER.indexOf(b as (typeof LOCALE_ORDER)[number]);
        const sa = ia === -1 ? 999 : ia;
        const sb = ib === -1 ? 999 : ib;

        if (sa !== sb) {
            return sa - sb;
        }

        return a.localeCompare(b);
    });
}
