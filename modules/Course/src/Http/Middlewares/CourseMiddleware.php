<?php
namespace Modules\Course\src\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;

class CourseMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}
