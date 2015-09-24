<?php

namespace misCursos\Http\Controllers;

use Illuminate\Http\Request;

use misCursos\Http\Requests;
use misCursos\Http\Controllers\Controller;
use misCursos\Model\Keysmoac;
use misCursos\Model\Ordermoac;
use misCursos\Model\Ctrlcodescci;


class KeysmoacController extends Controller
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

    public function find(Request $request){
        $datak=Keysmoac::where('key_activation','like','%'.$request->code.'%')->first();
        $data = Ordermoac::orderBy('ORDER_MOAC.id', 'desc')
            ->join('LICENSES_MOAC','ORDER_MOAC.id_license','=','LICENSES_MOAC.id')
            ->join('LANGUAGE_MOAC','ORDER_MOAC.id_language','=','LANGUAGE_MOAC.id')
            ->where('ORDER_MOAC.id',$datak->id_order)
            ->select('ORDER_MOAC.*','LICENSES_MOAC.name','LANGUAGE_MOAC.name AS idioma')->paginate(5);
        $i=0;
        foreach($data as $pag ){
            $id =$pag->id;
            $datakeys= Keysmoac::where('id_order',$id)->get();
            foreach($datakeys as $dk){
                $dataAr = $dk->toArray();
                $codeMoac = $dk->key_activation;
                $dataCtrl = Ctrlcodescci::where('sCode',$codeMoac)->first();
                if(!is_null($dataCtrl)){
                    $r =$data->Items()[$i];
                    $r['exis_jsp'] += true;

                }else{
                    $r =$data->Items()[$i];
                    $r['exis_jsp'] += false;
                    break;
                }
            }
            $i++;
        }
        $url_actual = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        $url_actual = explode('?',$url_actual);
        $data->setPath($url_actual[0]);
        return view('orders.list',compact('data'));


        //return $dataOrder->toJson();
    }
}
