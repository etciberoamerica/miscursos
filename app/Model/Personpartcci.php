<?php

namespace misCursos\Model;

use Illuminate\Database\Eloquent\Model;
use misCursos\Model\Personscci;
use Log;

class Personpartcci extends Model
{
    protected $connection = 'sqlsrv_four';
    protected $table='ACtrl_PersonsPartner';
    public $timestamps = false;

    public static function getPartnet(){
        $data= Personpartcci::
        join('Cat_Persons as cp', 'cp.idPerson', '=', 'ACtrl_PersonsPartner.idPerson')
            ->join('ACat_PartnerAInfo as pin', 'pin.idPartner', '=', 'ACtrl_PersonsPartner.idPartner')
            ->select('pin.idPartner', 'pin.sTradeName')
            ->orderBy('pin.sTradeName')
            ->groupBy('pin.sTradeName', 'pin.idPartner')
            ->lists('pin.sTradeName','pin.idPartner');

        dd($data);
        return $data;
    }

    public static function reportGeneral($dat = null){

            $texto = "";
            $data = Personscci::name(($dat['institu'])?$dat['institu']:'')->
            join('Ctrl_Activations as b','Cat_Persons.idPerson','=','b.idPerson')
                ->join('Ctrl_ProfessorStudents as c','c.idStudent','=','Cat_Persons.idPerson')
                ->join('ACtrl_PersonsPartner as d','d.idPerson','=','c.idProfessor')
                ->join('ACat_PartnerAInfo as e','e.idPArtner','=','d.idPartner')
                ->join('Cat_Persons as a2','c.idProfessor','=','a2.idPerson')
                ->select('Cat_Persons.sName','Cat_Persons.sLastName',
                    'Cat_Persons.sEmail as EmailUsuario',
                    'Cat_Persons.dUTCRegistrationDate',
                    //'CONVERT(varchar(50), Cat_Persons.dUTCRegistrationDate, 103) as fechaRegistro',
                    'b.sCode','e.sTradeName','a2.sEmail as EmailProfesor')
                ->orderBy('Cat_Persons.sLastName', 'desc')->paginate(15);

        $url_actual = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        $url_actual = explode('?',$url_actual);
        $data->setPath($url_actual[0]);
        return $data;
    }



}
