<?php

namespace misCursos\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Student
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

        $user = Auth::user();
        if ($request->ajax()) {
            return response('Unauthorized.', 401);
        } else if($user->rol_id != 1){
            return redirect('/');
        }
        return $next($request);
    }
}
