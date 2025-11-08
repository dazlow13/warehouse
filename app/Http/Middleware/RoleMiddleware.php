<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Cho phép admin truy cập tất cả
        if ($user->role === 'admin' || in_array($user->role, $roles)) {
            return $next($request);
        }


        abort(403, 'Unauthorized');

    }
}