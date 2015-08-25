<?php

namespace misCursos\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use misCursos\Model\User;
use misCursos\Model\Productoetc;
use misCursos\Model\Group;
use misCursos\Model\Tool;
use misCursos\Model\Groupetc;

use Illuminate\Http\Request;

use misCursos\Http\Requests;
use misCursos\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */


    protected $error = false;
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
        //dd(Auth::user());
        $productos = [];
        $productos += [''=>'Seleccione producto'];
        $productos += Productoetc::getListPro()->toArray();

        $gra = [];
        $gra += [''=> 'Seleccione grado'];
        $gra += Group::getListGroup()->toArray();


        return view('teacher.teacher',compact('productos','gra'));
    }

    public function groupRegister(Request $request){
        //dd($request->all());

        $g =[];
        $g +=$request->all();
        $g +=['key'=>Tool::generateKey(['LEN'=>10,'MI'=>false,'MA'=>true,'NU'=>true,'CA'=>false])];
        $data= Tool::removeSpace($g);

        //dd(Groupetc::where('keygroup_grupo',$data['key'])->first());

        //dd($data);
        //dd(count($data['Products']));

        $validator= Validator::make($data,[
            'Producto'      => 'required|numeric',
            'Grado'         => 'required|numeric',
            'Grupo'         => 'required|max:20|alpha_dash',
            'Descripción'   => 'required|max:20|alpha_dash',
            'key'           => 'required|max:10',
            'Products'      => 'array'

        ]);

        if($validator->fails()){
            //dd($validator->messages());
            //dd($validator->messages());
                    $error=1;
                 return Redirect::back()->withInput()->withErrors($validator->messages())->with('error',$error);

        }


        dd($data);

        foreach($data['Products'] as $key => $data){
            print_r($data);

        }
        exit();




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
