<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
      $user_has_role = false;
      foreach ($roles as $role) {
        if (!$user_has_role && Auth::check() && $request->user()->hasRole($role)) {
          $user_has_role = true;
        }
      }

      if (Auth::check() && $user_has_role) {
        return $next($request);
      }

      abort(403, 'Unauthorized action.');

      return redirect()->route('login');
    }
}
