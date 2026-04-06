/**
 * Laravel cookie `XSRF-TOKEN` for JSON/fetch requests with `credentials: 'same-origin'`.
 */
export function getCsrfTokenFromCookie(): string {
    if (typeof document === 'undefined') {
        return '';
    }

    const match = document.cookie.match(/XSRF-TOKEN=([^;]+)/);

    return match ? decodeURIComponent(match[1]) : '';
}
