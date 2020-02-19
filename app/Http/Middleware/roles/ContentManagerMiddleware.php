<?php

namespace App\Http\Middleware\roles;

use App\ModerationStatus;
use App\Service;
use Closure;
use Auth;
use Session;

class ContentManagerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->isContentManager()) {
            return $next($request);
        } else {
            Session::flash('warning', 'Доступ запрещен!');
            return redirect()->back();
        }
    }
}
