<?php

namespace misCursos\Model;

use Illuminate\Database\Eloquent\Model;

use Request;

class Productoetc extends Model
{
    protected $connection = 'mysql_one';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'etclearning_productos';

    public static function getListPro(){
        return Productoetc::where('estatus_producto','1')->orderBy('nombre_producto','ASC')->lists('nombre_producto', 'id');
    }

    public static function findAll($id){
        return Productoetc::find($id);
    }
}
