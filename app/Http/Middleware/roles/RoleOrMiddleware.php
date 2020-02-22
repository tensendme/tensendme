<?php

namespace App\Http\Middleware\roles;

use Closure;
use Auth;

class RoleOrMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roleIds)
    {
        if (in_array(Auth::user()->role_id, $roleIds)) {
            return $next($request);
        } else {
            request()->session()->flash('warning', 'Доступ запрещен!');
            return redirect()->back();
        }
    }
}
