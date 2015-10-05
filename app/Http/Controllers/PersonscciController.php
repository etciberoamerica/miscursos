<?php

namespace misCursos\Http\Controllers;

use Illuminate\Http\Request;

use misCursos\Http\Requests;
use misCursos\Http\Controllers\Controller;
use misCursos\Model\Personscci;

class PersonscciController extends Controller
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

    public function ReportGeneral(Request $request){



        /*
         *
         * select
            a.sName,
            a.sLastName,
            a.sEmail as EmailUsuario,
            CONVERT(varchar(50), a.dUTCRegistrationDate, 103) as fechaRegistro,
            sCode,
            e.sTradeName,
            a2.sEmail as EmailProfesor
            from [cci].[dbo].Cat_Persons as a
            JOIN [cci].[dbo].Ctrl_Activations as b ON a.idPerson = b.idPerson
            JOIN [cci].[dbo].Ctrl_ProfessorStudents as c ON c.idStudent = a.idPerson
            JOIN [cci].[dbo].ACtrl_PersonsPartner as d ON d.idPerson = c.idProfessor
            JOIN [cci].[dbo].ACat_PartnerAInfo as e ON e.idPArtner = d.idPartner
            join [cci].[dbo].Cat_Persons as a2 ON c.idProfessor = a2.idPerson
            where d.bProfesor= 1
            order by e.sTradeName, sLastName;
         * */

    }
}
