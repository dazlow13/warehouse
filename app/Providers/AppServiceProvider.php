<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    // app/Providers/AuthServiceProvider.php
    public function boot(): void
    {
        Blade::if('admin', function () {
            return Auth::check() && Auth::user()->role === 'admin';
        });

        Blade::if('manager', function () {
            return Auth::check() && Auth::user()->role === 'manager';
        });

        Blade::if('warehouse', function () {
            return Auth::check() && Auth::user()->role === 'warehouseman';
        });
        // Định nghĩa directive Blade cho kiểm tra vai trò người dùng
        Blade::if('role', function ($roles) {
            if (!Auth::check())
                return false;

            $userRole = Auth::user()->role;

            if (is_string($roles)) {
                $roles = preg_split('/[,|]/', str_replace(['[', ']', ' '], '', $roles));
            }

            return in_array($userRole, $roles);
        });
        // Định nghĩa directive Blade cho kiểm tra không thuộc vai trò người dùng
        Blade::if('notrole', function ($roles) {
            if (!Auth::check()) {
                return true;
            }
            $userRole = Auth::user()->role;
            if (is_array($roles)) {
                $roleList = $roles;
            } else {
                $roleList = preg_split('/[,|]/', str_replace(['[', ']', ' '], '', $roles));
            }

            return !in_array($userRole, $roleList);
        });
    }

}
