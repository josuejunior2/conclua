<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            if (str_contains($request->route()->getName(), 'admin') || auth()->guard('admin')->check()) {
                return route('admin.login');
            }
            return route('login');
        }
        // dd('...');

    }
}
