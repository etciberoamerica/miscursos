<?php

namespace misCursos\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Useretc extends Model
{
    protected $connection = 'mysql_one';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'etclearning_usuarios';

    public $timestamps = false;

    public static function getData(){
        return Useretc::first();

    }

    public static  function execProcedure(array $data){
        if($data['Genero'] =='M'){
            $genero="Masculino";
        }else{
            $genero='Femenino';
        }
        $telefono =12345678;

        try{
            $res= DB::connection('mysql_one')->select('CALL AgregarAlumnoV2(?,?,?,?,?,?,?,?,?,?)',
                array(
                    $data['Institución'],
                    $data['Nombre'],
                    $data['Apellido_Paterno'], $data['Apellido_Materno'],
                    $genero, $data['Fecha_nacimiento'], $telefono, $data['Email'], $data['Email'], $data['Password']));

            foreach( $res  as $r){
                return $r->salida;
                break;
            }

        }catch (ValidationException $e){
            $e->getError();
            abort('412','Ingreso de usuario ciidte');
        }

    }
}
