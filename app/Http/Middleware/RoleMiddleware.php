<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //return $next($request);

        if (!auth()->check()) {
            return redirect()->route("login");
        }

        $user = auth()->user();
        if ($user->role() === "admin" || $user->role() === "project_manager") {
            return $next($request);
        }

        $routeViewers = [
            "projects.index",
            "tasks.index",
            "projects.getdata",
            "tasks.getdata",
        ];

        $routeName = $request->route()->getName();

        if ($user->role() === "viewer" && in_array($routeName, $routeViewers)) {
            return $next($request);
        }

        abort(403, "Unauthorized access midd");
    }
}
