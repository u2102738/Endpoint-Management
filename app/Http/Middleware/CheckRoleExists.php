<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;

class CheckRoleExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $roleId = $request->route('id');

        // Check if the device exists in the database
        if (!Role::where('id', $roleId)->exists()) {
            // Device does not exist, redirect to invalid page
            return redirect()->route('pages.404','en');
        }

        return $next($request);
    }
}
