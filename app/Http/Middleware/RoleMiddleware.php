<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Nếu chưa đăng nhập thì quay về login
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['msg' => 'Vui lòng đăng nhập']);
        }

        $user = Auth::user();

        // Map role -> level
        $roles = [
            'admin'  => 0,
            'sadmin' => 1,
            'user'   => 2,
        ];

        // Nếu role không tồn tại trong map
        if (!isset($roles[$role])) {
            abort(403, 'Role không tồn tại.');
        }

        // Kiểm tra phân quyền
        $userLevel = (int)$user->level;
        $requiredLevel = $roles[$role];

        // Nếu user là sadmin (level 1), cho phép truy cập các route yêu cầu admin (level 0) hoặc sadmin
        if ($userLevel === $roles['sadmin'] && ($requiredLevel === $roles['admin'] || $requiredLevel === $roles['sadmin'])) {
            return $next($request);
        }

        // Nếu level user khớp với level yêu cầu
        if ($userLevel === $requiredLevel) {
            return $next($request);
        }

        abort(403, 'Bạn không có quyền: ' . $role);
    }
}