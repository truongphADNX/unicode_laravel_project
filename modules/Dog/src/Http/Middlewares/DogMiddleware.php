<?php
namespace Modules\Dog\src\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;

class DogMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}
