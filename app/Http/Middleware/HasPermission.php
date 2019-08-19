<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class HasPermission {

  /**
   * Handle an incoming request.
   *
   * @param \Illuminate\Http\Request $request
   * @param \Closure $next
   * @param string|null $guard
   * @return mixed
   */
  public function handle($request, Closure $next, $guard = null) {
    $user = Auth::user();
    $route = $request->route();
    $actions = $route->getAction();

    // Always deny access if permissions are invalid or missing.
    if (!is_array($actions['permissions'])) \App::abort(403);

    // Check each permission individually.
    foreach ($actions['permissions'] as $permission) {
      if (!$user->isAllowedTo($permission)) \App::abort(403);
    }

    return $next($request);
  }
}
