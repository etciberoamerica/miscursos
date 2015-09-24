<?php

namespace misCursos\Model;

use Illuminate\Database\Eloquent\Model;


use misCursos\Model\Appcci;
class Versionappcci extends Model
{
    protected  $connection='sqlsrv_four';
    protected   $table='Cat_VersionsApps';
    public $timestamps = false;



    public static function productos(){

        return $data = Versionappcci::join('Cat_Apps ','Cat_VersionsApps.idApp','=','Cat_Apps.idApp')
        ->select('Cat_Apps.sApp','Cat_VersionsApps.sVersion','Cat_VersionsApps.idVersion')->get();




    }

}
