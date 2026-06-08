<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecureHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (method_exists($response, 'header')) {
            $response->header('X-Frame-Options', 'SAMEORIGIN');
            $response->header('X-Content-Type-Options', 'nosniff');
            $response->header('Referrer-Policy', 'strict-origin-when-cross-origin');
            $csp = "default-src 'self' 'unsafe-inline' 'unsafe-eval' https:; img-src 'self' data: https:; font-src 'self' data: https:; frame-ancestors 'self'";
            if (app()->environment('local')) {
                $csp = "default-src 'self' 'unsafe-inline' 'unsafe-eval' http://localhost:5173 http://127.0.0.1:5173 http://[::1]:5173 ws://localhost:5173 ws://127.0.0.1:5173 ws://[::1]:5173 https:; img-src 'self' data: http://localhost:5173 http://127.0.0.1:5173 http://[::1]:5173 https:; font-src 'self' data: https:; frame-ancestors 'self'";
            }
            $response->header('Content-Security-Policy', $csp);
        }

        return $response;
    }
}
