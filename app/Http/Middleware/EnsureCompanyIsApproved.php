<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCompanyIsApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Check if user is a company and is not approved
        if ($user && $user->hasRole('empresa') && !$user->company_approved) {
            // Allow access only to the company-not-approved page and logout
            if (!$request->routeIs('company.not-approved') && !$request->routeIs('logout')) {
                return redirect()->route('company.not-approved');
            }
        }

        return $next($request);
    }
}
