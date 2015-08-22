<?php

namespace misCursos\Http\Controllers;

use misCursos\Model\User;
use misCursos\Model\Productoetc;
use misCursos\Model\Group;
use misCursos\Model\Tool;

use Illuminate\Http\Request;

use misCursos\Http\Requests;
use misCursos\Http\Controllers\Controller;

class UserController extends Controller
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

    /*
     * Inicio de funciones de estudiante
     */

    public function student(){
        return view('student/student');
    }
    /*
     * Fin de funciones de estudiante
     */

    /*
     * Inicio de funciones de docente
     */
    public function teacher(){
        $key =Tool::generateKey(['LEN'=>10,'MI'=>false,'MA'=>true,'NU'=>true,'CA'=>false]);



        $productos = [];
        $productos += [''=>'Seleccione producto'];
        $productos += Productoetc::getListPro()->toArray();

        $gra = [];
        $gra += [''=> 'Seleccione grado'];
        $gra += Group::getListGroup()->toArray();


        return view('teacher.teacher',compact('productos','gra'));
    }

    /*
     * fin de funciones de docente
     */


    /*
     * inicio de funciones de administrador
     */

    public function  admin(){
        return view('admin.administrator');
    }


    /*
     * fin de funciones de administrador
     */


    /*
     * inicio de funciones del accesor
     */
    public function adviser(){
        return view('adviser.adviser');
    }

    /*
     * fin de funciones del asesor
     */
}
