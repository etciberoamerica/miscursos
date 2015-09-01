<?php

namespace misCursos\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use misCursos\Model\User;
use misCursos\Model\Productoetc;
use misCursos\Model\Instgraetc;
use misCursos\Model\Tool;
use misCursos\Model\Grouprelation;
use misCursos\Model\Gradoetc;
use misCursos\Model\Group;

use misCursos\Http\Controllers\ProductoetcController;
use Illuminate\Http\Request as Request;

use misCursos\Http\Requests;
use misCursos\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;



use Session;
use DB;

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
    public function redirecTeach(){
        $productos = [];
        $productos += [''=>'Seleccione producto'];
        $productos += Productoetc::getListPro()->toArray();
        $gra = [];
        $gra += [''=> 'Seleccione grado'];
        $gra += Instgraetc::getListGroup()->toArray();
        $group = Group::where('actived',1)->orderBy('id','DESC')->paginate(10);
        return view('teacher.teacher',compact('productos','gra','group'));
    }

    public function teacher(){
        $productos = [];
        $productos += [''=>'Seleccione producto'];
        $productos += Productoetc::getListPro()->toArray();
        $gra = [];
        $gra += [''=> 'Seleccione grado'];
        $gra += Instgraetc::getListGroup()->toArray();
        $group = Group::where('actived',1)->orderBy('id','DESC')->paginate(10);
        return view('teacher.teacher',compact('productos','gra','group'));
    }

    public function groupRegister(Request $request){
        DB::beginTransaction();
        $g =[];
        $g +=$request->all();
        $g +=['key'=>Tool::generateKey(['LEN'=>10,'MI'=>false,'MA'=>true,'NU'=>true,'CA'=>false])];
        $data= Tool::removeSpace($g);
        $validator= Validator::make($data,[
            'Producto'      => 'required|numeric',
            'Grado'         => 'required|numeric',
            'Grupo'         => 'required|max:20|alpha_dash',
            'Descripción'   => 'required|max:20|alpha_dash',
            'key'           => 'required|max:10',
            'Products'      => 'array'

        ]);

        if($validator->fails()){
            $error=1;
            $table=ProductoetcController::buildProductTr($data['Products']);
            Session::flash('table', $table);
            return Redirect::back()->withInput()->withErrors($validator->messages())
                ->with('error',$error);
        }

        $Group =Group::create([
            'group_id'          => $data['Grado']
            ,'key'               => $data['key']
            ,'gruop_institution' => $data['Grupo']
            ,'description'       => $data['Descripción']
            ,'user_id'           => Auth::user()->id
        ]);
        $key_one=$data['key'];
        $group_id = $data['Grado'];
        $group = $data['Grupo'];
        $description = $data['Descripción'];
        $contador = count($data['Products']);

        foreach($data['Products'] as $key => $data){
            if($contador > 1){
                $ciidte_key=Tool::generateKey(['LEN'=>10,'MI'=>false,'MA'=>true,'NU'=>true,'CA'=>false]);
                $moac_key=Tool::generateKey(['LEN'=>10,'MI'=>false,'MA'=>true,'NU'=>true,'CA'=>false]);
            }else{
                $ciidte_key=$key_one;
                $moac_key=$key_one;
            }
            try{
                $res= DB::connection('sqlsrv_two')->select('EXEC AddGruposMOAC_CIIDTEv2 ?,?,?,?,?,?,?,?',
                    [
                        Auth::user()->email,
                        $Group->gruop_institution,
                        $Group->gruop_institution,
                        $moac_key,
                        Auth::user()->institution_id,
                        $data,
                        1,
                        '']);
                        foreach( $res  as $r){
                         $moac_group_id = $r->idG;
                        }

                $Gradoetc= Gradoetc::create([
                    'producto_id'                   =>$data,
                    'usuario_id'                    =>Auth::user()->ciidte_id,
                    'instgrado_id'                  =>$group_id,
                    'nombre_moodle_grupo'           =>$group,
                    'descripcion_moodle_grupo'      =>$description,
                    'enrolmentkey_moodle_grupo'     =>'-',
                    'activado_moodle_grupo'         =>'1',
                    'fecha_activado_moodle_grupo'   => date('Y-m-d H:m:s'),
                    'keygroup_grupo'                =>$ciidte_key,
                    'instgrupo_grupo'               =>$group_id,
                    'created'                       =>date('Y-m-d H:m:s'),
                    'modified'                      =>date('Y-m-d H:m:s'),
                    'estatus_grupo'                 =>1
                                    ]);

                Grouprelation::create([
                    'group_id'          =>$Group->id
                    ,'ciidte_group_id'  =>$Gradoetc->id
                    ,'moac_group_id'    =>$moac_group_id
                    ,'producto_id'      =>$data

                ]);


            }catch (\Exception $e){
                //echo "algo cocurrio mal";
                echo $e->getMessage();
                DB::rollback();

            }
        }

        DB::commit();
        return $this->redirecTeach();

    }




    public function getDate(Request $request){
        if ($request->ajax()) {

            $g =[];
            $g +=$request->all();
            $data= Tool::removeSpace($g);
            //dd($data['key']);



           $dataGroup= Group::where('key',$data['key'])->
                        join('mc_users','mc_users.id', '=', 'mc_groups.user_id')
                        ->select('mc_users.*', 'mc_groups.*')
                        ->get()->toArray();
            if(count($dataGroup) == 0){
                return 0;

            }

            /*
             * DB::table('users')
        ->join('contacts', function ($join) {
            $join->on('users.id', '=', 'contacts.user_id')
                 ->where('contacts.user_id', '>', 5);
        })
        ->get();
             */
            return $dataGroup;


        }
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

    public function prueba(){
        $key='20SSDHOQSF';
        $dataGroup= Group::where('key',$key)->
        join('mc_users','mc_users.id', '=', 'mc_groups.user_id')
            ->select('mc_users.*', 'mc_groups.*')
            ->get();

        return true;

        //dd($dataGroup);

    }
}
