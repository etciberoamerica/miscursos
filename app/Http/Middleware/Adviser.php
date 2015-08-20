<?php

namespace misCursos\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Adviser
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
        $user = is_null(Auth::user())? $user=0 : $user=Auth::user()->rol_id;
        if ($request->ajax()) {
            return response('Unauthorized.', 401);
        } else if($user != 4){
            return redirect('/');
        }
        return $next($request);
    }
}
