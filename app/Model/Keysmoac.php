<?php

namespace misCursos\Model;

use Illuminate\Database\Eloquent\Model;

use misCursos\Model\Ctrlcodescci;

class Keysmoac extends Model
{
    protected $connection = 'sqlsrv_two';
    protected $table = 'KEYS_MOAC';

    protected $fillable = [
        'id'
        ,'id_order'
        ,'id_status'
        ,'key_activation'
        ,'active'
        ,'dateadd'
        ,'datemodify'
    ];


    public static function CodeJasper($id){
        $dataK = Keysmoac::where('id',$id)->first();
        $f=true;
        switch (substr($dataK->key_activation,0,5)) {
            case 'MOT13':
                $producto=12; //Microsoft Outlook 2013
                break;
            case 'MWD13':
                $producto=8; //Microsoft Word Core 2013
                break;
            case 'MXL13':
                $producto=9; //Microsoft Excel Core 2013
                break;
            case 'MPP13':
                $producto=10; //Microsoft PowerPoint 2013
                break;
            case 'MAC13':
                $producto=11; //Microsoft Access 2013
                break;
            default:
                $f=false;
                break;
        }
        if($f){
            $dataCtrl = Ctrlcodescci::where('sCode',$dataK->key_activation)->first();

            if(is_null($dataCtrl)){
                Ctrlcodescci::create([
                        'iNoOrder'          => $producto
                        ,'sCode'            => $dataK->key_activation
                        ,'bDiagnosticExam'  =>0
                        ,'iUses'            =>1
                        ,'bActive'          =>1]);
            }

        }




    }

}
