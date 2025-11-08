<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

if (!function_exists('role_route')) {
    function role_route($name, $params = [])
    {
        $role = Auth::user()->role ?? null;

        if (!$role) {
            return route('login');
        }

        $routeName = "{$role}.{$name}";

        if (Route::has($routeName)) {
            return route($routeName, $params);
        }

        // fallback nếu không có route tương ứng
        return route('dashboard');
    }
}
