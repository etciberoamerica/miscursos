<?php

namespace misCursos\Http\Controllers\Auth;

use misCursos\Model\User;
use misCursos\Model\Usermoac;
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


        $userMoac = Usermoac::where('email',"'".$data['Email']."'")->get();

        dd($userMoac);




        /*


        return User::create([
            'institution_id' => $data['Institución'],
            'name'           => $data['Nombre'],
            'last_name'      => $data['Apellido_Paterno'],
            'last_name_m'    => $data['Apellido_Materno'],
            'country_id'     => $data['País'],
            'state_id'       => $data['Estado'],
            'city'           => $data['Ciudad'],
            'location'       => $data['Localidad'],
            'geneder'        => $data['Genero'],
            'birth_date'     => $data['Fecha_nacimiento'],
            'email'          => $data['Email'],
            'password'       => bcrypt($data['Password']),
            'rol_id'         =>'1'
        ]);*/
    }

    public function redirectPath()
    {
        return '/home';
    }
}
