<?php

namespace misCursos\Http\Controllers;

use Illuminate\Http\Request;

use misCursos\Http\Requests;
use misCursos\Http\Controllers\Controller;

use misCursos\Model\Usermoac;
use Artisaninweb\SoapWrapper\Facades\SoapWrapper;

class UsermoacController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public static  function webServicesDate(array $data)
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

}
