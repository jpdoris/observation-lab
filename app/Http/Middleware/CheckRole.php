<?php

namespace App\Http\Middleware;

use Closure;
use App\Traits\Encryptable;

class CheckRole
{
    use Encryptable;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (! $request->user()->isRole($role)) {
            abort(401, 'This action is unauthorized.');
        }
        return $next($request);
    }
}
