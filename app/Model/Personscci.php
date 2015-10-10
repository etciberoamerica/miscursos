<?php

namespace misCursos\Model;

use Illuminate\Database\Eloquent\Model;

class Personscci extends Model
{
    protected $connection = 'sqlsrv_four';
    protected $table='Cat_Persons';


    public function scopeName($query, $valor){
        if(!is_null($valor) && $valor !=0){
            $query->where('e.idPArtner','=',$valor);
        }
    }


}
