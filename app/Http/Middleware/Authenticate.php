<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    } protected function redirectTo($request): ?string
    {
        // Nếu request không phải API thì chuyển hướng login
        if (! $request->expectsJson()) {
            return route('auth.login');
        }

        return null;
    }
}
