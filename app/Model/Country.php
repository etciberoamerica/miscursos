<?php

namespace misCursos\Model;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $connection = 'sqlsrv_two';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'COUNTRY_MOAC';

    public static function getCountry(){
        $data = Country::where('active',1)->lists('name', 'id');
        return $data;
    }
}
