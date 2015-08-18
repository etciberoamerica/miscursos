<?php

namespace misCursos\Http\Controllers\Auth;

use misCursos\Model\User;
use misCursos\Model\Usermoac;
use misCursos\Model\Institution;
use misCursos\Model\Country;
use misCursos\Model\Tool;
use Validator;
use misCursos\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


use Artisaninweb\SoapWrapper\Facades\SoapWrapper;

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


    public function redirectPath()
    {
        return '/home';
    }

    /*
     * function create for webservices moac insert user
     */
    public function webServicesDate(array $data)
    {
        SoapWrapper::add(function ($service) {
            $service->name('currency')->wsdl('http://moac.etclatam.com/WSMOAC10/MOAC_Service.asmx?WSDL')
                ->trace(true)
                ->cache(WSDL_CACHE_NONE)
                ->options(['password' => 'PasswordSavingStudentDataMoac10']);
        });
        $data = array(
            'Nombre' => $data['Nombre'],
            'Apellidos' => $data['Apellido_Paterno'].' '.$data['Apellido_Materno'],
            'Pais' => $data['País'],
            'Estado' => $data['Estado'],
            'FechaNacimiento' => $data['Fecha_nacimiento'],
            'Telefono' => '0',
            'CodigoPostal' => '0',
            'Direccion' => 'N/A',
            'Localidad' => 'localidaW',
            'Ciudad' => $data['Localidad'],
            'Usuario' => $data['Email'],
            'Contrasenia' => $data['Password'],
            'Pregunta' => 'N/A',
            'Respuesta' => 'N/A',
        );
        $parametros =array('password'=>'PasswordSavingStudentDataMoac10','Alumno'=>$data);
        $s =SoapWrapper::service('currency', function ($service) use ($parametros,&$response) {
            $response =$service->call('MOAC_GuardarDatosPersonalesAlumno' , [$parametros]);
        });
        $respuesta =$response->MOAC_GuardarDatosPersonalesAlumnoResult->identificador;
        if($respuesta != 0){
            abort(408, 'Error de Registro de Usuario moac');
        }else{
            return true;
        }
    }

    protected function create(array $data)
    {
        $rweb =false;
        $userMoac = Usermoac::where('email',"'".$data['Email']."'")->first();
        //dd($userMoac);
        if(!$userMoac){
            //dd('envia al web');
            $rweb =$this->webServicesDate($data);
            //dd($rweb);
        }else{
            abort(409, 'Error de Registro de Usuario moac (Existente)');
        }

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
            'rol_id'         =>'1',
            'created_at'     =>date("Y/m/d H:i:s"),
            'updated_at'     =>date("Y/m/d H:i:s")
        ]);
        // }
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





}
