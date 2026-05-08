<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyAIMarketingToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $expectedToken = (string) config('services.aimarketing.api_token', '');
        $providedToken = (string) $request->bearerToken();

        if ($expectedToken === '' || $providedToken === '' || ! hash_equals($expectedToken, $providedToken)) {
            return new JsonResponse([
                'message' => 'Unauthorized.',
            ], 401);
        }

        return $next($request);
    }
}
