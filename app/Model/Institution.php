<?php

namespace misCursos\Model;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $connection = 'mysql_one';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'etclearning_institucions';


    public static function getListIns(){

        $data = Institution::where('estatus_institucion', 1)->where('tipo_institucion_id', 1)->orderBy('nombre_institucion', 'asc')->lists('nombre_institucion', 'id');
        return  $data;

    }
}
