<?php

namespace misCursos\Http\Controllers;

use Illuminate\Http\Request;

use misCursos\Http\Requests;
use misCursos\Http\Controllers\Controller;
use misCursos\Model\Usertts;

use DB;

class UserttsController extends Controller
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


    public static  function registerDate(array $data)
    {
        try{

           $user = Usertts::create([
                'id_country'        =>  $data['País'],
                'id_state'          =>  $data['Estado'],
                'active'            =>  '1',
                'first_name'        =>  $data['Nombre'],
                'last_name'         =>  $data['Apellido_Paterno']." ".$data['Apellido_Materno'],
                'birthday'          =>  $data['Fecha_nacimiento'],
                'city'              =>  $data['Ciudad'],
                'email'             =>  $data['Email'],
                'password'          =>  $data['Password'],
                'secret_question'   =>  'N/A',
                'secret_answer'     =>  'N/A',
            ]);

        }catch (ValidationException  $e){
            DB::rollback();
            dd($e->getErrors());
            abort('410','Ingreso de Usuario Tts');
        }
        return $user;
    }
}
