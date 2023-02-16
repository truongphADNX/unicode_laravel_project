<?php
namespace Modules\Categories\src\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;

class CategoriesMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}
