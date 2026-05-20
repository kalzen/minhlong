<?php

namespace App\Http\Middleware;

use App\Models\AccessLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class LogAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (! app()->runningInConsole() || app()->runningUnitTests()) {
            $userAgent = (string) $request->userAgent();
            AccessLog::query()->create([
                'path' => Str::limit($request->path(), 8192, ''),
                'method' => $request->method(),
                'ip' => $request->ip(),
                'user_agent' => Str::limit($userAgent, 8192, ''),
                'user_id' => $request->user()?->getAuthIdentifier(),
            ]);
        }

        return $response;
    }
}
