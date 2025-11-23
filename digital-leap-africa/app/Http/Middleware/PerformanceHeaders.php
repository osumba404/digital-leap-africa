<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PerformanceHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Add performance and security headers
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        
        // Enable HTTP/2 Server Push hints
        $response->headers->set('Link', '</css/app.css>; rel=preload; as=style', false);
        
        return $response;
    }
}
