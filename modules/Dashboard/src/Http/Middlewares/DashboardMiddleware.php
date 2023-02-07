<?php
namespace Modules\Dashboard\src\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;

class DashboardMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}
