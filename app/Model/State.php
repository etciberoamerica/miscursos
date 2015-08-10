<?php

namespace misCursos\Model;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $connection = 'sqlsrv_two';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'STATE_MOAC';

    public static function getStates($id){
        return State::where('id_country',$id)->lists('name','id');
    }
}
