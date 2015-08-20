<?php

namespace misCursos\Http\Controllers\Auth;


use misCursos\Model\User;
use misCursos\Model\Useretc;
use misCursos\Model\Usermoac;
use misCursos\Model\Institution;
use misCursos\Model\Country;
use misCursos\Model\Tool;
use misCursos\Model\Usertts;
use Validator;
use misCursos\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use misCursos\Http\Controllers\UsermoacController;
use misCursos\Http\Controllers\UserttsController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;



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
            'Fecha_nacimiento'  => 'required|date_format:"d-m-Y"',
            'Email'             => 'required|max:50|email|unique:mc_users',
            'Password'          => 'required|min:8',
            'Confirmacion_password'      => 'required|same:Password',
            'Captcha' => 'required|captcha',

        ]);


        return $val;
    }


    public function redirectPath()
    {
        return '/';
    }

    /*
     * function create for webservices moac insert user
     */

    protected function create(array $data)
    {
        $usertts=1;

       // dd($data);
        /*
         * Inicio de registro en tabla de mis cursos
         */

        $userMC=User::create([
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
            'rol_id'         =>'3'
        ]);
        /*
         * Fin de registro tabla de mis cursos
         */
        $email= $data['Email'];
        $userMoac = Usermoac::where('email',$email)->first(); //obtiene si existe  usuario en moac
                if(!$userMoac){
                    $rweb = UsermoacController::webServicesDate($data); //llamada a la peticion del webservices de moac
                }else{
                    abort(409, 'Error de Registro de Usuario moac (Existente)');
                }
                $userTts = Usertts::getData($data);
                if(!$userTts){
                    $rwewtts= UserttsController::registerDate($data);
                    $usertts= $rwewtts->id;
                }else{
                    abort(411, 'Error de Registro de Usuario tts (Existente)');
                }
                $data += ['tts_id' => $usertts];
                $ciidte_id = Useretc::execProcedure($data);
                $data += ['ciidte_id' => $ciidte_id];
                is_null($userMoac)? $moad_id=1 : $moad_id=$userMoac->id ;
                $data += ['moac_id' => $ciidte_id];
                User::execProcedure($data);
        return $userMC;

    }

    public function getRegister()
    {
        $data = [];
        $data += ['' => 'Selecciona Institución'];
        $data += Institution::getListIns()->toArray();
        //dd(Country::getCountry());
        $dataIns =[];
        $dataIns +=['' =>'Selecciona País'];
        $dataIns += Country::getCountry()->toArray();
        /*dd($data);
                exit();*/
        //return view('auth/register')
        return view('auth.register')
            ->with('data',$data)
            ->with('dataIns',$dataIns);
    }
    public function getLogin()
    {
        if (view()->exists('auth.authenticate')) {
            return view('auth.authenticate');
        }
        return view('login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {


        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        return redirect($this->loginPath())
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }

}
