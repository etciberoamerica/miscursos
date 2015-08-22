<?php

namespace misCursos\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->check()) {

           $user = Auth::user()->rol_id;

                switch($user){
                    case 1:
                        return redirect('/admin');
                        break;
                    case 2:
                        return redirect('/teacher');
                        break;
                    case 3:
                        return redirect('/student');
                        break;
                    case 4:
                        return redirect('/adviser');
                        break;
                    default:
                        return redirect('/home');
                        break;
                }

        }else{
            return $next($request);
        }


    }
}
