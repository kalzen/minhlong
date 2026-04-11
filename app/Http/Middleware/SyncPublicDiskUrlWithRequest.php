<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Filesystem\Factory as FilesystemFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

/**
 * Spatie Media and Storage::disk('public')->url() use filesystems.disks.public.url,
 * which defaults to APP_URL. That breaks uploaded images when the site is opened on a
 * different host, port, or subdirectory than APP_URL (common with XAMPP).
 *
 * We adjust config for the request lifetime (restored in finally). When the public disk
 * is not Laravel's testing fake, we purge the disk cache so a new URL is picked up.
 */
class SyncPublicDiskUrlWithRequest
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $this->syncPublicDiskUrlWithRequest()) {
            return $next($request);
        }

        $previousUrl = config('filesystems.disks.public.url');
        $root = $request->root();

        if ($root !== '') {
            Config::set('filesystems.disks.public.url', rtrim($root, '/').'/storage');
            $this->refreshPublicDiskIfNotTestingFake();
        }

        try {
            return $next($request);
        } finally {
            Config::set('filesystems.disks.public.url', $previousUrl);
            $this->refreshPublicDiskIfNotTestingFake();
        }
    }

    private function syncPublicDiskUrlWithRequest(): bool
    {
        $value = config('filesystems.sync_public_disk_url_with_request', true);

        if (is_bool($value)) {
            return $value;
        }

        return ! in_array(strtolower((string) $value), ['0', 'false', 'no', 'off'], true);
    }

    private function refreshPublicDiskIfNotTestingFake(): void
    {
        if ($this->publicDiskUsesTestingFakeRoot()) {
            return;
        }

        app(FilesystemFactory::class)->purge('public');
    }

    private function publicDiskUsesTestingFakeRoot(): bool
    {
        $path = str_replace('\\', '/', app(FilesystemFactory::class)->disk('public')->path('_'));

        return str_contains($path, '/framework/testing/disks/');
    }
}
