<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var Response $response */
        $response = $next($request);

        header_remove("x-powered-by");
        header_remove("server");

        $response->headers->add([
            'X-XSS-Protection' => '0',
            'Strict-Transport-Security' => 'max-age=31536000; includeSubDomains',
            'X-Frame-Options' => 'deny',
            'X-Content-Type-Options' => 'nosniff',
            'Content-Security-Policy' => "default-src 'self'; frame-ancestors 'none'",
            'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ]);


        return $response;
    }
}
