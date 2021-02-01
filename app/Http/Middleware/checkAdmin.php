<?php

namespace preventaBiox\Http\Middleware;

use Closure;

class checkAdmin
{
    public function handle($request, Closure $next)
    {
        if ($request->user()->name != "admin") {
            return redirect("/");
        }
        return $next($request);
    }
}