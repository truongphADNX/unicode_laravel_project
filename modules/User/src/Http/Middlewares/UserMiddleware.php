<?php
namespace Modules\User\src\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}
