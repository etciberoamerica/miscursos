<?php

namespace misCursos\Http\Controllers;

use Illuminate\Http\Request;


use misCursos\Http\Requests;
use misCursos\Http\Controllers\Controller;

use misCursos\Model\Ctrlcodescci;
use misCursos\Model\Keysmoac;

use misCursos\Model\Tool;

class CtrlcodescciController extends Controller
{

    public function insert(Request $request){
        $i=0;
        foreach($request->valores as $v){
            if($v['name'] == 'code[]'){
                Keysmoac::CodeJasper($v['value']);
            }
            $i++;
        }
       return 'bien';
    }

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
}
