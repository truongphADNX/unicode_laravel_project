<?php
namespace Modules\Teacher\src\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;

class TeacherMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}
