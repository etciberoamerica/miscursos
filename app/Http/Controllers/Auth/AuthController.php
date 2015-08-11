<?php

namespace misCursos\Http\Controllers\Auth;

use misCursos\User;
use misCursos\Model\Tool;
use Validator;
use misCursos\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    protected $redirectTo = '/';

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        $data= Tool::removeSpace($data);
        $val=  Validator::make($data, [
            "Institución"       => "required",
            'Nombre'            => 'required|max:20|AlphaSpace',
            'Apellido_Paterno'  => 'required|max:20|alpha',
            'Apellido_Materno'  => 'required|max:20|alpha',
            "País"              => "required",
            'Estado'            => 'required',
            'Ciudad'            => 'required|max:15|alpha',
            'Localidad'         => 'required|max:15|alpha',
            'Genero'            => 'required',
            'Fecha_nacimiento'  => 'required|date_format:"d/m/Y"',
            'Email'             => 'required|max:50|email|unique:mc_users',
            'Password'          => 'required|min:8',
            'Confirmacion_password'      => 'required|same:Password',
            'Captcha' => 'required|captcha',

        ]);


        return $val;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

        //dd($data);
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
