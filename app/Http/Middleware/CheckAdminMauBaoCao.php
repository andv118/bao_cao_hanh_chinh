<?php

namespace App\Http\Middleware;

use Closure;

use Auth;
use Session;

class CheckAdminMauBaoCao
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $userrole = Session::get('userrole');
            if ($userrole == 1 || $userrole == 2) {
                return $next($request);
            }
            return redirect()->route('admin.home');
        } else {
            return redirect()->route('loginn');
        }
    }
}
