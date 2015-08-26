<?php

namespace misCursos\Model;

use Illuminate\Database\Eloquent\Model;

class Instgraetc extends Model
{
    protected $connection = 'mysql_one';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'etclearning_instgrados';


    public static function getListGroup(){
        $data=Instgraetc::where('estatus_instgrado','1')->lists('nombre_instgrado', 'id');

        return$data;
    }
}
