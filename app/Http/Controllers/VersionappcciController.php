<?php

namespace misCursos\Http\Controllers;

use Illuminate\Http\Request;

use misCursos\Http\Requests;
use misCursos\Http\Controllers\Controller;


use misCursos\Model\Versionappcci;
use misCursos\Model\Appcci;
use misCursos\Model\Personpartcci;
use misCursos\Model\Personscci;

use Excel;


class VersionappcciController extends Controller
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


    public function report(){
        $data = Versionappcci::productos()->toJson();
        $data2 = Personpartcci::getPartnet()->toJson();
        $pagination = Personpartcci::reportGeneral();
        return view('reports.report',compact('data','data2','pagination'));
    }

    public function excelGeneral(Request $request){
            Excel::create('Laravel Excel', function($excel) {
                $excel->sheet('Relation', function($sheet) {
                    $data = Personscci::
                    join('Ctrl_Activations as b','Cat_Persons.idPerson','=','b.idPerson')
                        ->join('Ctrl_ProfessorStudents as c','c.idStudent','=','Cat_Persons.idPerson')
                        ->join('ACtrl_PersonsPartner as d','d.idPerson','=','c.idProfessor')
                        ->join('ACat_PartnerAInfo as e','e.idPArtner','=','d.idPartner')
                        ->join('Cat_Persons as a2','c.idProfessor','=','a2.idPerson')
                        ->select('Cat_Persons.sName As Nombre Alumno','Cat_Persons.sLastName As Apellido Alumno',
                            'Cat_Persons.sEmail as Correo Alumno',
                            'Cat_Persons.dUTCRegistrationDate as Fecha registro',
                            //'CONVERT(varchar(50), Cat_Persons.dUTCRegistrationDate, 103) as fechaRegistro',
                            'b.sCode as código','e.sTradeName as Institución','a2.sEmail as Correo Profesor')
                        ->orderBy('Cat_Persons.sLastName', 'desc')->get();
                    $sheet->fromArray($data);
                });
            })->export('xlsx');
    }


    public function reportSelect(Request $request){
        $pagination = Personpartcci::reportGeneral($request->all());
    }

}
