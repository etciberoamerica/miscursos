<?php

namespace misCursos\Model;

use Illuminate\Database\Eloquent\Model;

class Ctrlcodescci extends Model
{
    protected  $connection='sqlsrv_four';
    protected   $table='Ctrl_Codes';
    public $timestamps = false;

  protected  $fillable=[
      'iNoCode'
      ,'iNoOrder'
      ,'sCode'
      ,'bDiagnosticExam'
      ,'iUses'
      ,'bActive'
    ];
}
