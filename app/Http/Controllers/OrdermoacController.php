<?php

namespace misCursos\Http\Controllers;

use Illuminate\Http\Request;

use misCursos\Http\Requests;
use misCursos\Http\Controllers\Controller;

use misCursos\Model\Keysmoac;
use misCursos\Model\Ordermoac;
use misCursos\Model\Ctrlcodescci;



use Carbon\Carbon;

class OrdermoacController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $fechActualy= date('Y-m-d', strtotime("+1 day"));
        $fecham =Carbon::now()->format('-m-d');
        $fechaAc = Carbon::now();
        $YearAc=$fechaAc->format('Y');
        $YearMn= $YearAc - 1;
        $fechaAc=$fechaAc->format('Y-m-');
        $fechaMn=$YearMn.''.$fecham;
        $data = Ordermoac::
        whereBetween('ORDER_MOAC.dateadd', [$fechaMn, $fechActualy])
            ->orderBy('ORDER_MOAC.id', 'desc')
            ->join('LICENSES_MOAC','ORDER_MOAC.id_license','=','LICENSES_MOAC.id')
            ->join('LANGUAGE_MOAC','ORDER_MOAC.id_language','=','LANGUAGE_MOAC.id')
            ->whereIn('ORDER_MOAC.id_license',[97,101,102,104,105,106,110,111])
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
        return view('orders.index',compact('data'));
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

        //dd($request->all());
        $dta = Keysmoac::where('id_order',$request->order_id)->get();
        $data= [];
        $i=0;
        foreach($dta as $r){
            //echo $r->key_activation;
            $data[$i]['id'] = $r->id;
            $data[$i]['key_activation'] = $r->key_activation;
            $reData= Ctrlcodescci::where('sCode',$r->key_activation)->first();

            if(!is_null($reData)){
                $t=true;
            }else{
                $t= false;
            }
            $data[$i]['exist'] = $t;
                $i++;
        }
        return $data;

    }


    public function upload(Request $request){

        $dta = Keysmoac::where('id_order',$request->order_id)->get();

        foreach($dta as $r){

            $reData= Ctrlcodescci::where('sCode',$r->key_activation)->first();

            if(is_null($reData)){
                Keysmoac::CodeJasper($r->id);
            }
        }
        Return "bien";

    }
}