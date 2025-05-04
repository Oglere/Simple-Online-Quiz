<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureRecoverySession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $role = auth()->user()->role;

            return match ($role) {
                'Admin' => redirect('admin'),
                'Teacher' => redirect('teacher'),
                'Student' => redirect('student'),
                default => back()->withErrors(['error' => 'Invalid role.'])
            };
        }

        return $next($request);
    }

}
