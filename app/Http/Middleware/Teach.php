<?php

namespace misCursos\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class Teach
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
        if(!Auth::user()){
            return redirect('/');
        }else {
            $user = Auth::user();
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else if($user->rol_id != 2){
                return redirect('/');
            }
            return $next($request);
        }


    }
}
