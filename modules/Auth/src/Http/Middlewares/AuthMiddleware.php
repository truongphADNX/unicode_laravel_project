<?php
namespace Modules\Auth\src\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}
