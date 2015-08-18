<?php

namespace misCursos\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class Admin
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
        //dd(Auth::user());
        if(!Auth::user()){
            return redirect('/');

        }else{
            $user = Auth::user()->rol_id;
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else if($user != 1){
                return redirect('/');
            }
            return $next($request);
        }

    }
}
